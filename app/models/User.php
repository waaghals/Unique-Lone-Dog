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

        $this->hasMany('id', 'UniqueLoneDog\Models\PasswordChange', 'usersId', array(
            'foreignKey' => array(
                'message' => 'User cannot be deleted because it still has data in PasswordChange table'
            )
        ));

        $this->hasMany('id', 'UniqueLoneDog\Models\PasswordReset', 'usersId', array(
            'foreignKey' => array(
                'message' => 'User cannot be deleted because it still has data in the PasswordReset table'
            )
        ));
    }

}
