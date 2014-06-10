<?php

namespace UniqueLoneDog\Controllers;

use UniqueLoneDog\Forms\ItemSubmitForm;
use UniqueLoneDog\Models\Factories\ItemFactory;
use UniqueLoneDog\Models\Item;
use UniqueLoneDog\Models\Comment;
use UniqueLoneDog\Forms\AddCommentForm;

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
    private $addCommentForm;

    public function initialize()
    {
        $this->itemSubmitForm = new ItemSubmitForm();
        $this->itemFactory = new ItemFactory();
        $this->addCommentForm = new AddCommentForm();
    }

    public function addAction()
    {
        $this->view->pick('partials/genericForm');
        $this->view->form = $this->itemSubmitForm;
    }

    public function performAddItemAction()
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

    public function overviewAction()
    {
        $this->view->setVar("items", Item::find());
        $this->view->pick("Item/overview");
    }

    public function showAction($itemId)
    {
        $this->view->setVar("item", Item::findFirst(array($itemId)));
        $this->view->form = $this->addCommentForm;
        $this->view->pick("Item/show");
    }

    public function performAddCommentAction($itemId)
    {
        if (!$this->addCommentForm->isValid($this->request->getPost())) {
            foreach ($this->addCommentForm->getMessages() as $message) {
                $this->flash->error($message);
            }
        } else {
            $c = new Comment();
            $c->userId = $this->identity->getUser()->id;
            $c->itemId = $itemId;
            $c->text = $this->request->getPost('comment', 'striptags');
            if (!$c->save()) {
                $this->flash->error($c->getMessages());
            } else {
                $this->flashSession->success("Added comment.");
                return $this->response->redirect('item/show/' . $itemId);
            }
        }
        return $this->response->redirect('item/show/' . $itemId);
    }

    /*
     * Check if the contentType is an image
     */

    private function isImage($contentType)
    {
        $imageTypes = ["image/gif", "image/jpeg", "image/pjpeg", "image/png"];
        if (in_array($contentType, $imageTypes)) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Get the header information for an url
     * This way we can check if the url is a certain Internet media type
     */

    private function getRemoteHeader($url)
    {
        $curl = curl_init($url);

        // Only get the header
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Do request
        $result = curl_exec($curl);

        $ret = false;

        // If request did not fail
        if ($result !== false) {
            // If request was ok, check response code
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($statusCode == 200) {
                $ret = true;
            }
        }

        curl_close($curl);

        return $result;
    }

    /*
     * Get the Content type from the header information
     */

    private function getContentTypeFromHeader($header)
    {
        $results = split("\n", trim($header));
        $contentType = "";
        foreach ($results as $line) {
            if (strtok($line, ':') == 'Content-Type') {
                $parts = explode(":", $line);
                $contentType = trim($parts[1]);
            }
        }
        return contentType;
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
