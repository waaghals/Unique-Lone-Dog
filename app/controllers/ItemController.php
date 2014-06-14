<?php

namespace UniqueLoneDog\Controllers;

use UniqueLoneDog\Forms\ItemSubmitForm;
use UniqueLoneDog\Models\Factories\ItemFactory;
use UniqueLoneDog\Models\ItemTag;
use UniqueLoneDog\Models\Item;
use UniqueLoneDog\Models\Comment;
use UniqueLoneDog\Forms\AddCommentForm;
use Phalcon\Mvc\View;
use UniqueLoneDog\Models\Reputation;
use UniqueLoneDog\Breadcrumbs\Breadcrumbs;

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
    private $breadcrumbs;

    public function initialize()
    {
        $this->breadcrumbs    = new Breadcrumbs();
        $this->breadcrumbs->add("item", "item-overview");
        $this->itemSubmitForm = new ItemSubmitForm();
        $this->itemFactory    = new ItemFactory();
        $this->addCommentForm = new AddCommentForm();
        $this->view->disableLevel(View::LEVEL_LAYOUT);
    }

    public function exploreAction()
    {
        return;
        $query = $this->modelsManager->createQuery("SELECT * FROM UniqueLoneDog\Models\Item");
        $items = $query->execute();
    }

    public function addAction()
    {
        $this->breadcrumbs->add("add", "item-add");
        $this->view->setVar("breadcrumbs", $this->breadcrumbs->generate());
        $this->assets->addJs('js/addTagInput.js');

        $this->view->pick('partials/genericForm');
        $this->view->form = $this->itemSubmitForm;
    }

    public function deleteCommentAction($commentId)
    {
        $this->view->setVar("breadcrumbs", $this->breadcrumbs->generate());
        $comment = Comment::findFirstById($commentId);
        $item    = $comment->item;
        if ($comment != null) {
            if ($comment->delete() == false) {
                $this->flash->error("Error deleting comment.");

                foreach ($comment->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $this->flashSession->success("Succesfully deleted comment.");
            }
        }
        return $this->response->redirect('item/show/' . $item->id);
    }

    public function deleteItemAction($itemId)
    {
        $this->view->setVar("breadcrumbs", $this->breadcrumbs->generate());
        $item = Item::findFirstById($itemId);
        $this->deleteAllComments($item->comments);
        if ($item != null) {
            if ($item->delete() == false) {
                $this->flash->error("Error deleting comment.");

                foreach ($item->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $this->flashSession->success("Succesfully deleted item.");
            }
        }
        return $this->response->redirect('item/overview');
    }

    private function deleteAllComments($comments)
    {
        if ($comments != null) {
            foreach ($comments as $comment) {
                if ($comment->delete() == false) {
                    $this->flash->error("Error deleting comment.");
                    foreach ($comment->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                }
            }
        }
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
                //Add reputation
                $user = $this->identity->getUser();
                $user->increaseReputation(Reputation::ITEM_ADD);

                $this->flashSession->success("Item posted.");
                return $this->response->redirect('item/show/' . $item->id);
            }
        }
    }

    public function overviewAction()
    {
        $this->view->setVar("breadcrumbs", $this->breadcrumbs->generate());
        $this->assets->addCss('css/itemOverview.css');
        $this->view->setVar("items", Item::find());
        $this->view->pick("Item/overview");
    }

    public function showAction($itemId)
    {
        $this->view->setVar("breadcrumbs", $this->breadcrumbs->generate());
        $user = $this->identity->getUser();
        $user->increaseReputation(Reputation::ITEM_VIEW);

        $item = Item::findFirst($itemId);

        $this->view->setTemplateAfter('Item');
        $this->view->setVar("item", $item);
        $this->view->setVar("user", $user);
        $this->view->form = $this->addCommentForm;

        switch ($item->type) {
            case "Image":
                $this->view->pick("Item/showImage");
                break;
            case "Video":
                $this->view->pick("Item/showVideo");
                break;
            case "Youtube":
                $this->view->pick("Item/showYoutube");
                break;
            default:
                $this->view->pick("Item/show");
                break;
        }
    }

    public function performAddCommentAction($itemId)
    {
        if (!$this->addCommentForm->isValid($this->request->getPost())) {
            foreach ($this->addCommentForm->getMessages() as $message) {
                $this->flash->error($message);
            }
        } else {
            $user = $this->identity->getUser();

            $c         = new Comment();
            $c->userId = $user->id;
            $c->itemId = $itemId;
            $c->text   = $this->request->getPost('comment', 'striptags');
            if (!$c->save()) {
                $this->flash->error($c->getMessages());
            } else {
                $user->increaseReputation(Reputation::COMMENT_ADD);
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

    private function isVideo($contentType)
    {
        $imageTypes = ["video/webm", "video/avi", "video/mpeg", "video/mp4", "video/x-flv"];
        if (in_array($contentType, $imageTypes)) {
            return true;
        } else {
            return false;
        }
    }

    private function isYoutube($url)
    {
        $res = parse_url($url);
        if ($res['host'] === "www.youtube.com") {
            return true;
        }
        return false;
    }

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
        $results     = explode("\n", trim($header));
        $contentType = "";
        foreach ($results as $line) {
            if (strtok($line, ':') == 'Content-Type') {
                $parts       = explode(":", $line);
                $contentType = trim($parts[1]);
            }
        }
        return $contentType;
    }

    private function getItemFromPost()
    {
        $URI  = $this->request->getPost('URI');
        $type = $this->getType($URI);
        if (!isset($type)) {
            $type = "Site";
        }
        if ($type === "Youtube") {
            $res = parse_url($URI);
            $URI = "//" . $res['host'] . $res['path'] . $res['query'];
            $URI = str_replace("watchv=", "embed/", $URI);
        }
        $factory     = $this->itemFactory;
        $name        = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        $machineTags = $this->request->getPost('tag');

        $item = $factory->create($name, $URI, $description, $type);
        foreach ($machineTags as $machineTag) {
            if (!empty($machineTag)) {
                $tag = $this->tagFactory->create($machineTag);

                $itemTag       = new ItemTag();
                $itemTag->item = $item;
                $itemTag->tag  = $tag;

                $itemTag->save();
            }
        }
        return $item;
    }

    private function getType($URI)
    {
        $header      = $this->getRemoteHeader($URI);
        $contentType = $this->getContentTypeFromHeader($header);

        if ($this->isYoutube($URI)) {
            return "Youtube";
        }
        switch ($contentType) {
            case $this->isImage($contentType):
                return "Image";
            case $this->isVideo($contentType):
                return "Video";
        }
    }

}
