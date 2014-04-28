<?php

namespace UniqueLoneDog\Controllers;

use UniqueLoneDog\Forms\LoginForm;

class AccountController extends AbstractController
{

    private $loginForm;

    public function initialize()
    {
        $this->loginForm = new LoginForm();
    }

    public function loginFormAction()
    {
        if ($this->remember->exists()) {
            return $this->auth->loginWithRememberMe();
        }

        $this->view->form = $this->loginForm;
    }

    public function performLoginAction()
    {
        $email = $this->request->getPost("email");
        $pass = $this->request->getPost("password");

        if (!$this->loginForm->isValid($this->request->getPost())) {

            foreach ($this->loginForm->getMessages() as $message) {
                $this->flash->error($message);
            }
        } elseif ($this->auth->isValidLogin($email, $pass)) {

            $this->identity->setByEmail($email);
            $this->flash->success("Login successfull");
            return $this->response->redirect();
        } else {
            $this->flash->error("Email or password are incorrect.");
        }

        $this->view->pick("account/loginForm");
        $this->view->form = $this->loginForm;
    }

    public function signupAction()
    {

    }

}
