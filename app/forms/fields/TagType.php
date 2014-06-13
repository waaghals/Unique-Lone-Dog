<?php

/*
 * The MIT License
 *
 * Copyright 2014 Waaghals.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Forms\Element\Select;
use UniqueLoneDog\Validators\TagTypeValidator;

/**
 * Description of TagType
 *
 * @author Waaghals
 */
class TagType extends Select
{

    const NAME = "tagType[]";

    public function __construct()
    {
        parent::__construct(self::NAME);
        $options = array();
        foreach (TagTypeValidator::$options as $option) {
            $options[$option] = ucfirst($option);
        }
        $this->setOptions($options);
        $this->setLabel("Tag Part");
    }

}
