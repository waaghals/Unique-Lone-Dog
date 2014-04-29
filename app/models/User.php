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
    public $mustChangePassword;

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
     * @var string
     */
    public $password;

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

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        $this->mustChangePassword = 'N';
        $generator                = $this->getDI()->getRandom();
        $hasher                   = $this->getDI()->getSecurity();
        $this->salt               = $generator->generate(12);

        if (empty($this->password)) {
            $this->password = $generator->generate(12);
            $this->passhash = $hasher->hash($this->salt + $$this->password);

            // The user must change its password in first login
            $this->mustChangePassword = 'Y';
        }
    }

    public function initialize()
    {
        $this->skipAttributes(array('password'));
        $this->belongsTo('roleId', 'UniqueLoneDog\Models\Role', 'id');
        $this->belongsTo('statusId', 'UniqueLoneDog\Models\Status', 'id');

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
