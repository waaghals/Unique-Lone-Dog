<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\StringLength;

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

        $this->addValidator(
                new PresenceOf(array(
            'message' => 'The name is required'
        )));

        $this->addValidator(
                new StringLength(array(
            'max'            => 255,
            'min'            => 2,
            'messageMaximum' => 'We don\'t like really long names',
            'messageMinimum' => 'Name needs to be longer than two characters'
        )));
    }

}
