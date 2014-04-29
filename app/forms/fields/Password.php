<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Forms\Element\Password as PasswordElement;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * A single required password field
 *
 * @author Patrick
 */
class Password extends PasswordElement
{

    protected $field;

    public function __construct($name = 'password')
    {
        parent::__construct($name, array(
            'placeholder' => 'Password'
        ));

        $this->setLabel("Password");

        $this->addValidator(new PresenceOf(array(
            'message' => 'The password is required'
        )));
    }

}
