<?php

namespace UniqueLoneDog\Models;

class UserGroup extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $groupId;

    /**
     *
     * @var string
     */
    public $userId;

    /**
     *
     * @return boolean False when validation failed.
     */
    public function initialize()
    {
        $this->belongsTo('groupId', 'UniqueLoneDog\Models\Group', 'id', array('alias' => 'group')
        );
        $this->belongsTo('userId', 'UniqueLoneDog\Models\User', 'id', array('alias' => 'user')
        );
    }

    public function getSource()
    {
        return "user_group";
    }

}
