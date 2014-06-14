<?php

namespace UniqueLoneDog\Controllers;

use UniqueLoneDog\Forms\AddGroupForm,
    UniqueLoneDog\Models\Group,
    UniqueLoneDog\Models\UserGroup,
    UniqueLoneDog\Forms\FilterForm,
    UniqueLoneDog\Models\Filter,
    UniqueLoneDog\Models\Factories\FilterFactory;

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
        $slug = $this->dispatcher->getParam("slug");

        $group = Group::findFirstBySlug($slug);
        if (!isset($group->id)) {
            throw new \Exception(sprintf("No group found using slug: %s", $slug));
        }
        $filter          = new Filter();
        $filter->groupId = $group->id;

        $this->assets->addJs('js/addTagInput.js');
        $this->view->form = new FilterForm($filter);
        $this->view->pick("partials/genericForm");
    }

    public function performAddFilterAction()
    {
        $filter = new Filter();
        $form   = new FilterForm();
        if (!$form->isValid($this->request->getPost())) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
        } else {
            $factory         = new FilterFactory();
            $filter          = $factory->create($this->request->getPost('filter'));
            $filter->groupId = $this->request->getPost('groupId');
            if (!$filter->save()) {
                $this->flash->error($filter->getMessages());
                return $this->addFilterAction();
            }
        }

        $group = Group::findFirst($this->request->getPost('groupId'));
        $this->flashSession->success("Filter(s) added.");
        return $this->response->redirect(array(
                    "for"  => "group-show",
                    "slug" => $group->slug
        ));
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
