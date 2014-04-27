<?php

namespace UniqueLoneDog\Models;

use Phalcon\Mvc\Model\Validator\Email as Email;

class User extends \Phalcon\Mvc\Model
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
    public $email;

    /**
     *
     * @var string
     */
    public $password;

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
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
                new Email(
                array(
            "field" => "email",
            "required" => true,
                )
                )
        );
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    public function getSource()
    {
        return 'user';
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'password' => 'password',
            'mustChangePassword' => 'mustChangePassword',
            'roleId' => 'roleId',
            'statusId' => 'statusId'
        );
    }

    public function initialize()
    {
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
