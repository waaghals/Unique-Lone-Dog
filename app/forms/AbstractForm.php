<?php

namespace UniqueLoneDog\Forms;

use Phalcon\Forms\Form;

/**
 * Description of AbstractForm
 *
 * @author Patrick
 */
class AbstractForm extends Form
{

    public function addField(FormFieldInterface $field)
    {
        $this->add($field->getField());
    }

}
