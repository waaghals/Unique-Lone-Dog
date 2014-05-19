<?php

namespace UniqueLoneDog\Controllers;

use UniqueLoneDog\Forms\ItemSubmitForm;
use UniqueLoneDog\Models\Factories\ItemFactory;
use UniqueLoneDog\Validator;

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
 *
 * @property Identity $identity Identity library
 */
class ItemController extends AbstractController
{

    private $itemSubmitForm;
    private $itemFactory;

    public function initialize()
    {
        $this->itemSubmitForm = new ItemSubmitForm();
        $this->itemFactory = new ItemFactory();
    }

    public function AddAction()
    {
        if (!$this->identity->exists()) {
            $this->flash->error("You are not allowed here!");
            $this->response->redirect();
        }


        $this->view->pick('partials/genericForm');
        $this->view->form = $this->itemSubmitForm;
    }

    public function performAddListAction()
    {
        if (!$this->itemSubmitForm->isValid($this->request->getPost())) {

            foreach ($this->itemSubmitForm->getMessages() as $message) {
                $this->flash->error($message);
            }
        } else {
            $item = $this->getItemFromPost();

            if (!$item->save()) {
                $this->flash->error($item->getMessages());
            } else {
                $this->flash->success("Item created.");
                return $this->response->redirect();
            }
        }
    }

    private function getItemFromPost()
    {
        $factory = $this->itemFactory;
        $name = $this->request->getPost('name');
        $URI = $this->request->getPost('URI');
        $comment = $this->request->getPost('comment');

        return $factory->create($name, $URI, $comment);
    }

}
