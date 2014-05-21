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

    public function deleteGroup($groupId)
    {
        $userGroup = UserGroup::find($groupId);
        $userGroup->delete();
    }

    public function initialize()
    {
        $this->belongsTo('roleId', 'UniqueLoneDog\Models\Role', 'id', array(
            'alias' => 'role'
        ));

        $this->belongsTo('statusId', 'UniqueLoneDog\Models\Status', 'id', array(
            'alias' => 'status'
        ));

        $this->hasMany('id', 'UniqueLoneDog\Models\Group', 'userId', array(
            "alias"      => "userGroups",
            'foreignKey' => array(
                'message' => 'User cannot be deleted because it still has data in Group table'
            )
        ));

        $this->hasManyToMany(
                "id", "UniqueLoneDog\Models\UserGroup", "userId", "groupId", "UniqueLoneDog\Models\Group", "id", array("alias" => "groups"));
    }

}
