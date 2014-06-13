<?php

namespace UniqueLoneDog\Controllers;

use UniqueLoneDog\Forms\AddGroupForm,
    UniqueLoneDog\Models\Group,
    UniqueLoneDog\Models\UserGroup,
    UniqueLoneDog\Forms\FilterForm;

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

    public function showAction($slug)
    {
        $group = Group::findFirstBySlug($slug);
        $this->view->setVar("group", $group);
        $this->view->pick("group/single");
    }

    public function exploreGroupAction()
    {
        $this->view->setVar("groups", Group::find());
        $this->view->setVar("user", $this->identity->getUser());
        $this->view->pick("group/explore");
    }

    public function addFilterAction()
    {
        $this->view->form = new FilterForm();
        $this->view->pick("partials/genericForm");
    }

    private function showFilterForm()
    {

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
            return $this->response->redirect('group/explore');
        }
    }

    public function performUnsubscribeGroupAction($groupId)
    {
        $this->identity->getUser()->deleteGroup($groupId);
        $this->flashSession->success("Unsubscription complete.");
        return $this->response->redirect('group/explore');
    }

}
