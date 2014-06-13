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

namespace UniqueLoneDog\Models;

/**
 * A tag part and tag type to filter on the groups
 *
 * @author Waaghals
 */
class Filter extends \Phalcon\Mvc\Model
{

    public $groupId;
    public $type;
    public $part;

    public function getGroupId()
    {
        return $this->groupId;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getPart()
    {
        return $this->part;
    }

    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setPart($part)
    {
        $this->part = $part;
    }

    public function initialize()
    {
        $this->belongsTo('groupId', 'UniqueLoneDog\Models\Group', 'id',
                         array('alias' => 'group')
        );
    }

}
