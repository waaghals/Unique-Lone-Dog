<?php

namespace UniqueLoneDog\Forms;

use UniqueLoneDog\Forms\Fields\EmailField;
use UniqueLoneDog\Forms\Fields\PasswordField;
use UniqueLoneDog\Forms\Fields\RememberMeField;
use UniqueLoneDog\Forms\Fields\CSRFField;
use UniqueLoneDog\Forms\Fields\ButtonField;

/**
 * A simple login form
 *
 * @author Patrick
 */
class LoginForm extends AbstractForm
{

    public function initialize()
    {
        $this->addField(new EmailField());
        $this->addField(new PasswordField('password'));
        $this->addField(new RememberMeField());
        $this->addField(new CSRFField($this->security->getSessionToken()));
        $this->addField(new ButtonField("Sign In"));
    }

}
