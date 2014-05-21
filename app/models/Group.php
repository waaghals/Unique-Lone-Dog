<?php

namespace UniqueLoneDog\Models;

use Phalcon\Mvc\Model\Validator\Uniqueness;

class Group extends \Phalcon\Mvc\Model
{

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
    public $description;

    /**
     *
     * @var string
     */
    public $users;

    /**
     *
     * @return boolean False when validation failed.
     */
    public function validation()
    {
        $this->validate(new Uniqueness(array(
            "field"    => "name",
            "required" => true,
        )));

        //If validation failed, return false.
        return !$this->validationHasFailed();
    }

    public function initialize()
    {
        $this->hasMany('id', 'UniqueLoneDog\Models\User', 'groupId', array(
            "alias"      => "groupUsers",
            'foreignKey' => array(
                'message' => 'Group cannot be deleted because it still has data in User table'
            )
        ));
        $this->hasManyToMany(
                "id", "UniqueLoneDog\Models\UserGroup", "groupId", "userId", "UniqueLoneDog\Models\User", "id", array("alias" => "users")
        );
    }

}
