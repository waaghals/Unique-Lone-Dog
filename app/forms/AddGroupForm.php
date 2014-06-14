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
 * Form fields for signup
 *
 * @author Patrick
 */
class AddGroupForm extends Form
{

    public function initialize()
    {
        $this->add(new Fields\Name());
        $this->add(new Fields\Description());
        $this->add(new Fields\CSRF($this->security->getSessionToken()));
        $this->add(new Fields\Button("Create Group"));
    }

}
