<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Mvc\Model\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

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
            new Confirmation(array(
                'message' => 'Password doesn\'t match confirmation',
                'with'    => 'confirmPassword'
                    ))
        ));
    }

}
