<?php

namespace UniqueLoneDog\Routes;

/**
 * Holds the routes for the account controller
 *
 * @author Patrick
 */
class AccountRoutes extends \Phalcon\Mvc\Router\Group
{

    public function initialize()
    {
        $this->setPaths(array(
            'controller' => 'account'
        ));

        $this->setPrefix('/account');

        /**
         * Login
         */
        $this->addGet("/login", array(
            "action" => "loginForm"
        ))->setName("account-login");

        $this->addPost("/login", array(
            "action" => "performLogin"
        ));

        /**
         * Logout
         */
        $this->addGet("/logout", array(
            "action" => "logout"
        ))->setName("account-logout");

        /**
         * Signup
         */
        $this->addGet("/signup", array(
            "action" => "signUpForm"
        ))->setName("account-signup");

        $this->addPost("/signup", array(
            "action" => "performSignUp"
        ));
    }

}
