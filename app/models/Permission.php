<?php

namespace UniqueLoneDog\Models;

class Permission extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $roleId;

    /**
     *
     * @var string
     */
    public $resource;

    /**
     *
     * @var string
     */
    public $action;

    public function getSource()
    {
        return 'permission';
    }

    public function initialize()
    {
        $this->belongsTo('roleName', 'UniqueLoneDog\Models\Role', 'name', array(
            'alias' => 'role'
        ));
    }

}
