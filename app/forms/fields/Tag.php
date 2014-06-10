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

    const NAME = "tag[]";

    public function __construct()
    {
        parent::__construct(self::NAME,
                            array(
            'placeholder' => 'namespace:predicate=value',
            'class'       => 'tagInput',
            'pattern'     => TagValidator::REGEX
        ));

        $this->setLabel("Tag");

        $this->addValidator(new TagValidator());
    }

}
