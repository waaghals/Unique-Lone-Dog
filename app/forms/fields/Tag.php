<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Forms\Element\Text;
use UniqueLoneDog\Validators\TagValidator;

/**
 * A machine tag/triple tag input field
 *
 * @author Patrick
 */
class Tag extends Text
{

    public function __construct()
    {
        parent::__construct('tag', array(
            'placeholder' => 'Tag',
            'pattern'     => TagValidator::REGEX
        ));

        $this->setLabel("Tag");

        $this->addValidator(new TagValidator());
    }

}
