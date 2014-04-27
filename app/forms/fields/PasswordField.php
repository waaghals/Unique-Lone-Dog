<?php

namespace UniqueLoneDog\Forms\Fields;

use UniqueLoneDog\Forms\FormFieldInterface;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * A single required password field
 *
 * @author Patrick
 */
class PasswordField implements FormFieldInterface
{

    public function getField()
    {
        $password = new Password('password', array(
            'placeholder' => 'Password'
        ));

        $password->addValidator(new PresenceOf(array(
            'message' => 'The password is required'
        )));

        return $password;
    }

}
