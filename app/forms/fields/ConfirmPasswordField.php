<?php

namespace UniqueLoneDog\Forms\Fields;

/**
 * Password field with the name 'confirmPassword' and a different label
 *
 * @author Patrick
 */
class ConfirmPasswordField extends PasswordField
{

    public function __construct()
    {
        parent::__construct("confirmPassword");
        $this->field->setLabel("Repeat password");
    }

}
