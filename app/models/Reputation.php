<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UniqueLoneDog\Models;

use Phalcon\Mvc\Model\Behavior\Timestampable;

/**
 * Description of Reputation
 *
 * @author Patrick
 */
class Reputation extends \Phalcon\Mvc\Model
{

    const ALGO_STEEPNESS    = 100; //Higher numbers, decrease slope
    const ACCOUNT_REGISTER  = 50;
    const ACCOUNT_LOGIN     = 2;
    const PAGE_VIEW         = 1;
    const ITEM_ADD          = 50;
    const TAG_ADD           = 25;
    const GROUP_ADD         = 75;
    const ITEM_DELETE       = 15;
    const TAG_DELETE        = 20;
    const ITEM_VIEW         = 1;
    const GROUP_SUBSCRIBE   = 4;
    const GROUP_UNSUBSCRIBE = 10;
    const COMMENT_ADD       = 10;
    const COMMENT_DELETE    = 15;

    /**
     *
     * @var int
     */
    public $points;

    public function initialize()
    {
        $this->belongsTo('userId', 'UniqueLoneDog\Models\User', 'id',
                         array(
            'alias' => 'user'
        ));

        $this->addBehavior(new Timestampable(array(
            'beforeValidationOnCreate' => array(
                'field'  => 'createdAt',
                'format' => 'Y-m-d H:i:s'
            )
        )));
    }

}
