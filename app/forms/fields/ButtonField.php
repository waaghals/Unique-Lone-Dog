<?php

namespace UniqueLoneDog\Forms\Fields;

use UniqueLoneDog\Forms\FormFieldInterface;
use Phalcon\Forms\Element\Submit;

/**
 * Simple submit button
 *
 * @author Patrick
 */
class ButtonField implements FormFieldInterface
{

    const SECONDARY = "btn-secondary ";
    const DISABLED = "disabled ";
    const ACTIVE = "active ";

    protected $field;

    public function __construct($value, $classes = "")
    {
        $this->field = new Submit($value, array(
            'class' => trim('btn ' . $classes)
        ));
    }

    public function getField()
    {
        return $this->field;
    }

}
