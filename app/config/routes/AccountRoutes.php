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

        $this->addGet("/login", array(
            "action" => "loginForm"
        ));

        $this->addPost("/login", array(
            "action" => "performLogin"
        ));
    }

}
