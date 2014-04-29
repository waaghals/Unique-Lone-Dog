<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\Identical;

/**
 * Field to prevent Cross-site request forgery
 *
 * @author Patrick
 */
class CSRF extends Hidden
{

    private $token;

    public function __construct($token)
    {
        $this->token  = $token;
        $this->_value = $token;
        parent::__construct('csrf');

        $this->addValidator(new Identical(array(
            'value'   => $this->token,
            'message' => 'CSRF validation failed'
        )));
    }

}
