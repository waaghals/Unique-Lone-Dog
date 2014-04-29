<?php

namespace UniqueLoneDog\Forms;

use Phalcon\Forms\Form;

/**
 * A simple login form
 *
 * @author Patrick
 */
class LoginForm extends Form
{

    public function initialize()
    {
        $this->add(new Fields\Email());
        $this->add(new Fields\Password());
        $this->add(new Fields\RememberMe());
        $this->add(new Fields\CSRF($this->security->getSessionToken()));
        $this->add(new Fields\Button("Sign In"));
    }

}
