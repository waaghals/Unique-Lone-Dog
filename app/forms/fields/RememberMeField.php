<?php

namespace UniqueLoneDog\Forms\Fields;

use UniqueLoneDog\Forms\FormFieldInterface;
use Phalcon\Forms\Element\Check;

/**
 * A required email field
 *
 * @author Patrick
 */
class RememberMeField implements FormFieldInterface
{

    public function getField()
    {
        $remember = new Check('remember', array(
            'value' => 'yes'
        ));

        $remember->setLabel('Remember me');

        return $remember;
    }

}
