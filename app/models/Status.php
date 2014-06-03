<?php

namespace UniqueLoneDog\Models;

class Status extends \Phalcon\Mvc\Model
{

    const NON_CONFIRMED = "non-confirmed";

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $name;

    public function getSource()
    {
        return 'status';
    }

    public function initialize()
    {
        $this->hasMany('name', 'UniqueLoneDog\Models\User', 'statusName', array(
            'foreignKey' => array(
                'message' => 'Status cannot be deleted because it\'s used on a User'
            )
        ));
    }

}
