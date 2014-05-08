<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Forms\Element\Submit;

/**
 * Simple submit button
 *
 * @author Patrick
 */
class Button extends Submit
{

    const SECONDARY = "btn-secondary ";
    const DISABLED  = "disabled ";
    const ACTIVE    = "active ";

    protected $field;

    public function __construct($value, $classes = "")
    {
        parent::__construct($value, array(
            'class' => trim('btn ' . $classes)
        ));
    }

}
