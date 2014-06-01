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
     * @var integer
     */
    public $roleId;

    /**
     *
     * @var integer
     */
    public $statusId;

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

    public function initialize()
    {
        $this->belongsTo('roleId', 'UniqueLoneDog\Models\Role', 'id', array(
            'alias' => 'role'
        ));

        $this->belongsTo('statusId', 'UniqueLoneDog\Models\Status', 'id', array(
            'alias' => 'status'
        ));

        $this->hasMany('id', 'UniqueLoneDog\Models\LoginSuccess', 'usersId', array(
            'foreignKey' => array(
                'message' => 'User cannot be deleted because it still has data in LoginSuccess table'
            )
        ));

        $this->hasMany('id', 'UniqueLoneDog\Models\Reputation', 'userId', array(
            'alias'      => 'points',
            'foreignKey' => array(
                'message' => 'User cannot be deleted because it still has data in Reputation table'
            )
        ));

        $this->hasMany('id', 'UniqueLoneDog\Models\PasswordReset', 'usersId', array(
            'foreignKey' => array(
                'message' => 'User cannot be deleted because it still has data in the PasswordReset table'
            )
        ));
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

}
