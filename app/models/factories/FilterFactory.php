<?php

/*
 * The MIT License
 *
 * Copyright 2014 Patrick.
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

namespace UniqueLoneDog\Models\Factories;

use UniqueLoneDog\Validators\TagValidator,
    UniqueLoneDog\Models\Filter;

/**
 * Factory for quickly creating filters
 *
 * @author Patrick
 */
class FilterFactory
{

    /**
     * Create a filter from a string representation
     *
     * @param string $filter
     * @return \UniqueLoneDog\Models\Tags\ValueTag
     */
    public function create($filter)
    {
        $f  = new Filter();
        $re = sprintf('/[%s]/',
                      TagValidator::PREDICATE_DELIMITER . TagValidator::VALUE_DELIMITER);
        @list($f->namespace, $f->predicate, $f->value) = preg_split($re, $filter);

        if (!isset($f->predicate)) {
            $f->predicate = "";
        }

        if (!isset($f->value)) {
            $f->value = "";
        }

        return $f;
    }

}
