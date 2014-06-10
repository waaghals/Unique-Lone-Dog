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

namespace UniqueLoneDog\Models\Tags;

/**
 * Value part of a MachineTag
 *
 * @author Patrick
 * @property PredicateTag $predicate Predicate this value belongs to
 */
class ValueTag extends AbstractTag
{

    public function initialize()
    {
        $this->belongsTo("predicate_id", "PredicateTag", "id",
                         array(
            "alias" => "predicate"
        ));

        $this->hasManyToMany(
                "id", "UniqueLoneDog\Models\ItemTag", "tagId", "itemId",
                "UniqueLoneDog\Models\Tags\Item", "id",
                array(
            "alias" => "items"
        ));

        $this->hasMany('id', 'UniqueLoneDog\Models\ItemTag', 'tagId',
                       array(
            'alias' => 'itemTags'
        ));
    }

    public function getSource()
    {
        return "value_tag";
    }

    /**
     * Return a string representation of a machine tag/triple tag
     * Format namepace:predicate=value
     *
     * @return string
     */
    public function __toString()
    {
        $predicate = $this->predicate->part;
        $namespace = $this->predicate->namespace->part;
        $value     = $this->part;

        return sprintf("%s:%s=%s", $namespace, $predicate, $value);
    }

}
