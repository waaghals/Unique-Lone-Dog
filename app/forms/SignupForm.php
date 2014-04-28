<?php

namespace UniqueLoneDog\Forms;

use UniqueLoneDog\Forms\Fields\NameField;
use UniqueLoneDog\Forms\Fields\PasswordRegistrationField;
use UniqueLoneDog\Forms\Fields\ConfirmPasswordField;
use UniqueLoneDog\Forms\Fields\EmailField;
use UniqueLoneDog\Forms\Fields\ButtonField;
use UniqueLoneDog\Forms\Fields\TosField;
use UniqueLoneDog\Forms\Fields\CSRFField;

/**
 * Form fields for signup
 *
 * @author Patrick
 */
class SignUpForm extends Form
{

    public function initialize()
    {
        $this->addField(new NameField());
        $this->addField(new EmailField());
        $this->addField(new PasswordRegistrationField());
        $this->addField(new ConfirmPasswordField);
        $this->addField(new TosField());
        $this->addField(new CSRFField());
        $this->addField(new ButtonField("Sign Up"));
    }

}
