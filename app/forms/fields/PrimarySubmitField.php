<?php

namespace UniqueLoneDog\Forms\Fields;

use UniqueLoneDog\Forms\FormFieldInterface;
use Phalcon\Forms\Element\Submit;

/**
 * Simple submit button
 *
 * @author Patrick
 */
class PrimarySubmitField implements FormFieldInterface
{

    public function getField()
    {
        return new Submit('go', array(
            'class' => 'btn btn-success'
        ));
    }

}
