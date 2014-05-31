<?php

namespace UniqueLoneDog\Models;

class Role extends \Phalcon\Mvc\Model
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
    public $active;

    public function getSource()
    {
        return 'role';
    }

    /**
     * Define relationships to Users and Permissions
     */
    public function initialize()
    {
        $this->hasMany('name', 'UniqueLoneDog\Models\User', 'roleName', array(
            'foreignKey' => array(
                'message' => 'Role cannot be deleted because it\'s used on a User'
            )
        ));

        $this->hasMany('name', 'UniqueLoneDog\Models\Permission', 'roleName', array(
            'alias' => 'permissions'
        ));
    }

}
