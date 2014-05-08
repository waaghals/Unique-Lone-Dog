<?php

namespace UniqueLoneDog\Models;

class RememberToken extends \Phalcon\Mvc\Model
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
    public $token;

    /**
     *
     * @var string
     */
    public $userAgent;

    /**
     *
     * @var integer
     */
    public $createdAt;

    public function getSource()
    {
        return 'remember_token';
    }

    public function initialize()
    {
        $this->belongsTo('userId', 'UniqueLoneDog\Models\User', 'id');
    }

    public function beforeValidationOnCreate()
    {
        // Timestamp the confirmaton
        $this->createdAt = time();
    }

}
