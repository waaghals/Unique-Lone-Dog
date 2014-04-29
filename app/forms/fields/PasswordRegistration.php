<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Validation\Validator\Confirmation;

/**
 * Password field with added validation for password strenght
 *
 * @author Patrick
 */
class PasswordRegistration extends Password
{

    public function __construct()
    {
        parent::__construct();

        $this->addValidators(array(
            new Confirmation(array(
                'message' => 'Password doesn\'t match confirmation',
                'with'    => 'confirmPassword'
                    ))
        ));
    }

}
