<?php

namespace UniqueLoneDog\Forms\Fields;

use UniqueLoneDog\Forms\FormFieldInterface;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\Identical;

/**
 * Field to prevent Cross-site request forgery
 *
 * @author Patrick
 */
class CSRFField implements FormFieldInterface
{

    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function getField()
    {
        $csrf = new Hidden('csrf');

        $csrf->addValidator(new Identical(array(
            'value'   => $this->token,
            'message' => 'CSRF validation failed'
        )));

        return $csrf;
    }

}
