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

    protected $field;

    public function __construct($name = 'password')
    {
        $this->field = new Password($name, array(
            'placeholder' => 'Password'
        ));

        $this->field->setLabel("Password");

        $this->field->addValidator(new PresenceOf(array(
            'message' => 'The password is required'
        )));
    }

    public function getField()
    {
        return $this->field;
    }

}
