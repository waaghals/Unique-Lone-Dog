<?php

namespace UniqueLoneDog\Controllers;

use UniqueLoneDog\Forms\AddGroupForm;
use UniqueLoneDog\Models\Group;
use UniqueLoneDog\Models\UserGroup;

class GroupController extends AbstractController
{

    private $addGroupForm;

    public function initialize()
    {
        if ($this->identity->exists()) {
            $this->addGroupForm = new AddGroupForm();
        } else {
            return $this->response->redirect("home");
        }
    }

    public function indexAction()
    {
        $this->view->setVar("groups", $this->identity->getUser()->groups);
        $this->view->pick("group/index");
    }

    public function exploreGroupAction()
    {
        $this->view->setVar("groups", Group::find());
        $this->view->setVar("user", $this->identity->getUser());
        $this->view->pick("group/explore");
    }

    public function addGroupFormAction()
    {

        $this->view->pick("group/add");
        $this->view->form = $this->addGroupForm;
    }

    public function performAddGroupAction()
    {

        if (!$this->addGroupForm->isValid($this->request->getPost())) {
            foreach ($this->addGroupForm->getMessages() as $message) {
                $this->flash->error($message);
            }
        } else {
            $g              = new Group();
            $g->name        = $this->request->getPost('name', 'striptags');
            $g->description = $this->request->getPost('description', 'striptags');
            if (!$g->save()) {
                $this->flash->error($g->getMessages());
            } else {
                $this->flashSession->success("Group created.");
                $this->performSubscribeGroupAction($g->id);
                return $this->response->redirect('group');
            }
        }
        return $this->addGroupFormAction();
    }

    public function performSubscribeGroupAction($groupId)
    {
        $u          = new UserGroup();
        $u->groupId = $groupId;
        $u->userId  = $this->identity->getUser()->id;
        if (!$u->save()) {
            $this->flash->error($u->getMessages());
        } else {
            $this->flashSession->success("Subscription complete.");
            return $this->response->redirect('group');
        }
    }

    public function performUnsubscribeGroupAction($groupId)
    {
        $this->identity->getUser()->deleteGroup($groupId);
        $this->flashSession->success("Unsubscription complete.");
        return $this->response->redirect('group/explore');
    }

}
