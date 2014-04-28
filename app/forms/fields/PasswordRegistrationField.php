<?php

namespace UniqueLoneDog\Forms\Fields;

/**
 * Password field with added validation for password strenght
 *
 * @author Patrick
 */
class PasswordRegistrationField extends PasswordField
{

    public function __construct()
    {
        parent::__construct();

        $this->field->addValidators(array(
            new StringLength(array(
                'min' => 8,
                'messageMinimum' => 'Password is too short. Minimum 8 characters'
                    )),
            new Confirmation(array(
                'message' => 'Password doesn\'t match confirmation',
                'with' => 'confirmPassword'
                    ))
        ));
    }

}
