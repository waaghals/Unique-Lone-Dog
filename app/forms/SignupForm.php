<?php

namespace UniqueLoneDog\Forms;

use UniqueLoneDog\Forms\Fields\PasswordRegistration;
use Phalcon\Forms\Form;

/**
 * Form fields for signup
 *
 * @author Patrick
 */
class SignUpForm extends Form
{

    public function initialize()
    {
        $this->add(new Fields\Name());
        $this->add(new Fields\Email());
        $this->add(new PasswordRegistration());
        $this->add(new Fields\ConfirmPassword());
        $this->add(new Fields\Tos());
        $this->add(new Fields\CSRF($this->security->getSessionToken()));
        $this->add(new Fields\Button("Sign Up"));
    }

}
