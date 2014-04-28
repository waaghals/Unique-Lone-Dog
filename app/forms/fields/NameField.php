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
class NameField implements FormFieldInterface
{

    public function getField()
    {
        $name = new Text('name');

        $name->setLabel('Name');

        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'The name is required'
                    ))
        ));

        return $name;
    }

}
