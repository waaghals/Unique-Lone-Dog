<?php

namespace UniqueLoneDog\Controllers;

use UniqueLoneDog\Forms\LoginForm;
use UniqueLoneDog\Forms\SignUpForm;

class AccountController extends AbstractController
{

    private $loginForm;
    private $signUpForm;

    public function initialize()
    {
        $this->loginForm  = new LoginForm();
        $this->signUpForm = new SignUpForm();
    }

    public function loginFormAction()
    {
        if ($this->remember->exists()) {
            return $this->auth->loginWithRememberMe();
        }

        $this->view->pick("partials/genericForm");
        $this->view->form = $this->loginForm;
    }

    public function performLoginAction()
    {
        $email = $this->request->getPost("email");
        $pass  = $this->request->getPost("password");

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

        $this->view->pick("partials/genericForm");
        $this->view->form = $this->loginForm;
    }

    public function performSignUpAction()
    {
        if (!$this->signUpForm->isValid($this->request->getPost())) {

            foreach ($this->signUpForm->getMessages() as $message) {
                $this->flash->error($message);
            }
        } else {
            $m = "Account created. You'll need to verify your email before you'll be able to use your account.";
            $this->flash->success($m);

            return $this->response->redirect();
        }

        $this->view->pick("partials/genericForm");
        $this->view->form = $this->signUpForm;
    }

    public function signUpFormAction()
    {
        $this->view->pick("partials/genericForm");
        $this->view->form = $this->signUpForm;
    }

}
