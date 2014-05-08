<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email as EmailValidator;

/**
 * A required email field
 *
 * @author Patrick
 */
class Email extends Text
{

    public function __construct()
    {
        parent::__construct('email', array(
            'placeholder' => 'Email'
        ));

        $this->setLabel("Email");

        $this->addValidators(array(
            new PresenceOf(array(
                'message' => 'The e-mail is required'
                    )),
            new EmailValidator(array(
                'message' => 'The e-mail is not valid'
                    ))
        ));
    }

}
