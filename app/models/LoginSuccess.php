<?php

namespace UniqueLoneDog\Models;

class LoginSuccess extends \Phalcon\Mvc\Model
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
    public $userId;

    /**
     *
     * @var string
     */
    public $ipAddress;

    /**
     *
     * @var string
     */
    public $userAgent;

    public function getSource()
    {
        return 'login_success';
    }

    public function initialize()
    {
        $this->belongsTo('userId', 'UniqueLoneDog\Models\User', 'id');
    }

}
