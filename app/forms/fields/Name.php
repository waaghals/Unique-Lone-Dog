<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * A required email field
 *
 * @author Patrick
 */
class Name extends Text
{

    public function __construct()
    {
        parent::__construct('name');

        $this->setLabel('Name');

        $this->addValidators(array(
            new PresenceOf(array(
                'message' => 'The name is required'
        ))));
    }

}
