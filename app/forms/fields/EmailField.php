<?php

namespace UniqueLoneDog\Forms\Fields;

use UniqueLoneDog\Forms\FormFieldInterface;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

/**
 * A required email field
 *
 * @author Patrick
 */
class EmailField implements FormFieldInterface
{

    public function getField()
    {
        $email = new Text('email', array(
            'placeholder' => 'Email'
        ));

        $email->setLabel("Email");

        $email->addValidators(array(
            new PresenceOf(array(
                'message' => 'The e-mail is required'
                    )),
            new Email(array(
                'message' => 'The e-mail is not valid'
                    ))
        ));

        return $email;
    }

}
