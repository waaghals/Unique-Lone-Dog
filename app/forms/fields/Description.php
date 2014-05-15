<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * A required email field
 *
 * @author Patrick
 */
class Description extends Text
{

    public function __construct()
    {
        parent::__construct('description');

        $this->setLabel('Description');

        $this->addValidators(array(
            new PresenceOf(array(
                'message' => 'The description is required'
        ))));
    }

}
