<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UniqueLoneDog\Forms;

use UniqueLoneDog\Forms\Fields;
use Phalcon\Forms\Form;

/**
 *
 * @author Jelle
 */
class AddCommentForm extends Form
{

    public function initialize()
    {
        $this->add(new Fields\Comment());
        $this->add(new Fields\Button("Add comment"));
    }

}
