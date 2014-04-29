<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\Identical;

/**
 * Simple Terms of service checkbox
 *
 * @author Patrick
 */
class Tos extends Check
{

    public function __construct()
    {
        parent::__construct('terms', array(
            'value' => 'yes'
        ));

        $this->setLabel('Accept terms and conditions');

        $this->addValidator(new Identical(array(
            'value'   => 'yes',
            'message' => 'Terms and conditions must be accepted'
        )));
    }

}
