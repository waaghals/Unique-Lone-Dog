<?php

namespace UniqueLoneDog\Forms\Fields;

/**
 * Password field with the name 'confirmPassword' and a different label
 *
 * @author Patrick
 */
class ConfirmPassword extends Password
{

    public function __construct()
    {
        parent::__construct("confirmPassword");
        $this->setLabel("Repeat password");
    }

}
