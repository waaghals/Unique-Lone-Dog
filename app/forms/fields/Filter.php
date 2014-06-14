<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Forms\Element\Text;
use UniqueLoneDog\Validators\TagValidator;

/**
 * A special machine tag/triple tag input field for filtering
 *
 * @author Patrick
 */
class Filter extends Text
{

    const NAME = "filter";

    public function __construct()
    {
        parent::__construct(self::NAME,
                            array(
            'placeholder' => 'namespace:predicate=value'
        ));

        $this->setLabel("Filter");

        $this->addValidator(new TagValidator());
    }

}
