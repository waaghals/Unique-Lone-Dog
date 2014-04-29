<?php

namespace UniqueLoneDog\Forms\Fields;

use UniqueLoneDog\Forms\FormFieldInterface;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\Identical;

/**
 * Simple Terms of service checkbox
 *
 * @author Patrick
 */
class TosField implements FormFieldInterface
{

    public function getField()
    {
        $terms = new Check('terms', array(
            'value' => 'yes'
        ));

        $terms->setLabel('Accept terms and conditions');

        $terms->addValidator(new Identical(array(
            'value'   => 'yes',
            'message' => 'Terms and conditions must be accepted'
        )));

        return $terms;
    }

}
