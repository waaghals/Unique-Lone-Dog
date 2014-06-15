<?php

namespace UniqueLoneDog\Controllers;

use UniqueLoneDog\Models\User,
    UniqueLoneDog\Forms\LoginForm,
    UniqueLoneDog\Forms\SignUpForm,
    UniqueLoneDog\Models\Reputation,
    UniqueLoneDog\Breadcrumbs\Breadcrumbs;

/**
 *
 * @property UniqueLoneDog\Identity $identity Identity library
 */
class AccountController extends AbstractController
{

    private $loginForm;
    private $signUpForm;
    private $breadcrumbs;

    public function initialize()
    {
        $this->breadcrumbs = new Breadcrumbs();

        $this->loginForm  = new LoginForm();
        $this->signUpForm = new SignUpForm();
    }

    public function loginFormAction()
    {
        if ($this->identity->exists()) {
            return $this->response->redirect(array("for" => "home"));
        }
        $this->breadcrumbs->add("Login", "account-login");
        $this->view->setVar("breadcrumbs", $this->breadcrumbs->generate());
        if ($this->remember->exists()) {
            return $this->auth->loginWithRememberMe();
        }

        $this->view->form = $this->loginForm;
    }

    public function performLoginAction()
    {
        $this->breadcrumbs->add("Login", "account-login");
        $this->view->setVar("breadcrumbs", $this->breadcrumbs->generate());
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
        $user->increaseReputation(Reputation::ACCOUNT_LOGIN);
    }

    public function performSignUpAction()
    {
        $post = $this->request->getPost();
        $user = new User();

        $this->signUpForm->bind($post, $user);
        if (!$this->signUpForm->isValid()) {
            //Form not valid
            $messages   = $this->signUpForm->getMessages();
            if ($this->signUpForm->getEntity() != null)
                $messages[] = $this->signUpForm->getEntity()->getMessages();

            foreach ($messages as $message) {
                $this->flash->error($message);
            }
        } elseif ($user->save()) {
            $this->flashSession->success("Account created.");
            $user->increaseReputation(Reputation::ACCOUNT_REGISTER);
            return $this->response->redirect();
        }
        $user->validation();
        if ($user->getMessages() != null)
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }
        return $this->signUpFormAction();
    }

    public function signUpFormAction()
    {
        $this->breadcrumbs->add("Signup", "account-signup");
        $this->view->setVar("breadcrumbs", $this->breadcrumbs->generate());
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
