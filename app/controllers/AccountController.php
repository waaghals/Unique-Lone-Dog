<?php

namespace UniqueLoneDog\Controllers;

use UniqueLoneDog\Models\User,
    UniqueLoneDog\Forms\LoginForm,
    UniqueLoneDog\Forms\SignUpForm,
    UniqueLoneDog\Models\Reputation;

/**
 *
 * @property UniqueLoneDog\Identity $identity Identity library
 */
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

        $this->view->form = $this->loginForm;
    }

    public function performLoginAction()
    {
        //$email = $this->request->getPost("email");
        $pass = $this->request->getPost("password");

        $post = $this->request->getPost();
        $user = new User();
        $this->loginForm->bind($post, $user);

        if (!$this->loginForm->isValid()) {

            foreach ($this->loginForm->getMessages() as $message) {
                $this->flash->error($message);
            }
        } elseif ($this->auth->isValidLogin($user->email, $pass)) {


            $this->loginUser($user->email);

            $this->flash->success("Login successfull");
            return $this->response->redirect();
        } else {
            $this->flash->error("Email or password are incorrect.");
        }

        $this->view->pick("account/loginForm");
        $this->view->form = $this->loginForm;
    }

    private function loginUser($email)
    {
        $this->identity->setByEmail($email);
        $user = $this->identity->getUser();
        $user->increaseReputation(Reputation::LOGIN);
    }

    public function performSignUpAction()
    {
        $post = $this->request->getPost();
        $user = new User();

        $this->signUpForm->bind($post, $user);
        if (!$this->signUpForm->isValid()) {
            $messages   = $this->signUpForm->getMessages();
            $messages[] = $this->signUpForm->getEntity()->getMessages();

            foreach ($messages as $message) {
                $this->flash->error($message);
            }
        } else {


            if (!$user->save()) {
                $this->flash->error($user->getMessages());
            } else {
                $this->flash->success("Account created.");
                $user->increaseReputation(Reputation::REGISTRATION);
                return $this->response->redirect();
            }
            $this->flashSession->success("Account created.");

            return $this->response->redirect();
        }

        return $this->signUpFormAction();
    }

    public function signUpFormAction()
    {
        $this->view->pick("partials/genericForm");
        $this->view->form = $this->signUpForm;
    }

    public function logoutAction()
    {
        $this->identity->remove();

        $this->flash->success("Logged out");

        return $this->response->redirect();
    }

}
