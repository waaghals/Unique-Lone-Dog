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

    const ALGO_STEEPNESS = 100; //Higher numbers, decrease slope
    const REGISTRATION   = 50;
    const LOGIN          = 2;
    const PAGEVIEW       = 1;
    const ADD_ITEM       = 10;
    const ADD_TAG        = 4;
    const POST_DELETED   = 15;
    const TAG_DELETED    = 20;

    /**
     *
     * @var int
     */
    public $points;

    public function initialize()
    {
        $this->belongsTo('userId', 'UniqueLoneDog\Models\User', 'id', array(
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
