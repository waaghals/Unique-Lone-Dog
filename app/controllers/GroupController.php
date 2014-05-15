<?php

namespace UniqueLoneDog\Controllers;

use UniqueLoneDog\Forms\AddGroupForm;
use UniqueLoneDog\Models\Group;

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
        $this->view->setVar("groups", Group::find());
        $this->view->pick("group/index");
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
            $g = new Group();
            $g->name = $this->request->getPost('name', 'striptags');
            $g->description = $this->request->getPost('description', 'striptags');
            if (!$g->save()) {
                $this->flash->error($g->getMessages());
            } else {
                $this->flash->success("Group created.");
                return $this->response->redirect('group');
            }
        }

        return $this->addGroupFormAction();
    }

}
