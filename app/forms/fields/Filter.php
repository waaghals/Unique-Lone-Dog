<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Forms\Element\Text;
use UniqueLoneDog\Validators\TagValidator;

/**
 * A special machine tag/triple tag input field for filtering
 *
 * @author Patrick
 */
class Filter extends Tag
{

    public function __construct()
    {
        parent::__construct();

        $this->setLabel("Filter");
    }

}
