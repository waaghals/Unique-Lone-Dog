<?php

namespace UniqueLoneDog\Models;

use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\Email;

class User extends \Phalcon\Mvc\Model
{

    CONST SALT_FIELD_SIZE = 64;

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $passhash;

    /**
     *
     * @var string
     */
    public $salt;

    /**
     *
     * @var string
     */
    public $statusName;

    /**
     *
     * @return boolean False when validation failed.
     */
    public function validation()
    {
        $this->validate(new Email(array(
            'field' => 'email'
        )));

        $this->validate(new Uniqueness(array(
            "field"    => "email",
            "required" => true,
        )));

        //If validation failed, return false.
        return !$this->validationHasFailed();
    }

    public function deleteGroup($groupId)
    {
        $userGroup = UserGroup::find($groupId);
        $userGroup->delete();
    }

    public function initialize()
    {
        $this->belongsTo('statusName', 'UniqueLoneDog\Models\Status', 'name',
                         array(
            'alias' => 'status'
        ));


        $this->hasMany('id', 'UniqueLoneDog\Models\LoginSuccess', 'usersId',
                       array(
            'foreignKey' => array(
                'message' => 'User cannot be deleted because it still has data in LoginSuccess table'
            )
        ));

        $this->hasMany('id', 'UniqueLoneDog\Models\Reputation', 'userId',
                       array(
            'alias'      => 'points',
            'foreignKey' => array(
                'message' => 'User cannot be deleted because it still has data in Reputation table'
            )
        ));
        $this->hasMany('id', 'UniqueLoneDog\Models\Group', 'userId',
                       array(
            "alias"      => "userGroups",
            'foreignKey' => array(
                'message' => 'User cannot be deleted because it still has data in Group table'
            )
        ));

        $this->hasMany('id', 'UniqueLoneDog\Models\Item', 'itemId',
                       array(
            'foreignKey' => array(
                'message' => 'Item cannot be deleted because it\'s used on a User'
            )
        ));


        $this->hasManyToMany(
                "id", "UniqueLoneDog\Models\UserGroup", "userId", "groupId",
                "UniqueLoneDog\Models\Group", "id",
                array(
            "alias" => "groups"
        ));
    }

    /**
     * Set a new password, will regenerate a new salt.
     *
     * @param string $password The new password
     */
    public function setPassword($password)
    {
        $security       = $this->getDI()->get("security");
        $this->salt     = $security->getSaltBytes();
        $hash           = $security->hash($this->salt + $password);
        $this->passhash = $hash;
    }

    /**
     * Set the default role and status before creation
     */
    public function beforeValidation()
    {
        if ($this->statusName == null) {
            $status           = Status::findFirstByName('non-confirmed');
            $this->statusName = $status->name;
        }
    }

    /**
     * Increase the users reputation
     *
     * @param int $points
     * @param \UniqueLoneDog\Models\User $from
     */
    public function increaseReputation($points, User $from = null)
    {
        $multiplier = 1;
        if ($from !== null) {
            $multiplier = $this->reputationMultiplier($from);
        }

        $this->mutateReputation($points * $multiplier);
    }

    /**
     * Decrease the users reputation
     *
     * @param int $points
     * @param \UniqueLoneDog\Models\User $from
     */
    public function decreaseReputation($points, User $from = null)
    {
        $multiplier = 1;
        if ($from !== null) {
            $multiplier = $this->reputationMultiplier($from);
        }

        $negative = 0 - ($points * $multiplier);
        $this->mutateReputation($negative);
    }

    /**
     * Create a new reputation mutation row
     *
     * @param int $points
     */
    private function mutateReputation($points)
    {
        $reputation         = new Reputation();
        $reputation->points = \intval($points);
        $reputation->user   = $this;
        $reputation->save();
    }

    /**
     * Get the multiplier for the reputation change.
     * f(x) = log100(|otherRep - userRep| + 1) + 1
     *
     * @param \UniqueLoneDog\Models\User $otherUser
     * @return int
     */
    private function reputationMultiplier(User $otherUser)
    {
        $currRep  = $this->getReputation();
        $otherRep = $otherUser->getReputation();
        $delta    = \abs($otherRep - $currRep);
        return \log($delta + 1, Reputation::ALGO_STEEPNESS) + 1;
    }

    /**
     * Get the current reputation for this user
     * @return int
     */
    public function getReputation()
    {
        $reputation = 0;
        foreach ($this->points as $mutation) {
            $reputation += $mutation->points;
        }
        return $reputation;
    }

    /**
     * Get the reputation for a user in human readable format.
     * Reputation above 2000 is shortend to 2.0k
     *
     * @return string
     */
    public function getHumanReputation()
    {
        $rep = $this->getReputation();
        if ($rep >= 2000) {
            return \sprintf("%.1f", $rep / 1000) . 'k';
        } else {
            return $rep;
        }
    }

    public function getRole()
    {
        $bind = array("rep" => $this->getReputation());

        $manager     = $this->getDI()->get('modelsManager');
        //Get the reputation for all users
        $numberQuery = "SELECT "
                . "COUNT(*) AS count "
                . "FROM UniqueLoneDog\Models\User AS u ";
        $lessQuery   = "SELECT "
                . "SUM(r.points) as reputation "
                . "FROM UniqueLoneDog\Models\Reputation AS r "
                . "GROUP BY r.userId "
                . "HAVING reputation < :rep:";
        $sameQuery   = "SELECT "
                . "SUM(r.points) as reputation "
                . "FROM UniqueLoneDog\Models\Reputation AS r "
                . "GROUP BY r.userId "
                . "HAVING reputation = :rep:";

        /**
         * PR% = L + ( 0.5 x S ) / N
         *
         * Where,
         * L = Number of below rank,
         * S = Number of same rank,
         * N = Total numbers.
         */
        $N        = $manager->executeQuery($numberQuery)->getFirst()['count'];
        $lessRows = $manager->executeQuery($lessQuery, $bind);
        $L        = count($lessRows);
        $sameRows = $manager->executeQuery($sameQuery, $bind);
        $S        = count($sameRows);

        $pr = $L + ( 0.5 * $S ) / $N;

        $roleQuery = "SELECT r.name AS role "
                . "FROM UniqueLoneDog\Models\Role AS r "
                . "WHERE r.power <= :pr: "
                . "ORDER BY r.power DESC "
                . "LIMIT 1";

        $role = $manager
                        ->executeQuery($roleQuery, array("pr" => $pr))
                        ->getFirst()['role'];
        return $role;
    }

}
