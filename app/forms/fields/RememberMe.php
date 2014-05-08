<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Forms\Element\Check;

/**
 * A required email field
 *
 * @author Patrick
 */
class RememberMe extends Check
{

    public function __construct()
    {
        parent::__construct('remember', array(
            'value' => 'yes'
        ));

        $this->setLabel('Remember me');
    }

}
