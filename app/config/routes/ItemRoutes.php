<?php

namespace UniqueLoneDog\Routes;

/*
 * The MIT License
 *
 * Copyright 2014 Tojba.
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

/**
 * Description of ItemRoutes
 *
 * @author Tojba
 */
class ItemRoutes extends \Phalcon\Mvc\Router\Group
{

    public function initialize()
    {
        $this->setPaths(array(
            'controller' => 'item'
        ));

        $this->setPrefix('/item');

        $this->addGet("/add", array(
            "action" => "add"
        ))->setName("item-add");

        $this->addPost("/add",
                array(
            "action" => "performAddItem"
        ));

        $this->addPost("/show/{id}",
                array(
            "action" => "performAddComment"
        ))->setName("add-comment");

        $this->addGet("/", array(
            "action" => "overview"
        ))->setName("item-overview");

        $this->addGet("/show/{id}",
                array(
            "action" => "show"
        ))->setName("item-show");

        $this->addPost("/deleteComment/{commentId}",
                array(
            "action" => "deleteComment"
        ))->setName("delete-comment");

        $this->addPost("/deleteItem/{itemId}",
                array(
            "action" => "deleteItem"
        ))->setName("delete-item");
    }

}
