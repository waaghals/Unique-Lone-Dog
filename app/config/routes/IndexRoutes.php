<?php

namespace UniqueLoneDog\Routes;

/**
 * Holds the routes for the index controller
 *
 * @author Patrick
 */
class IndexRoutes extends \Phalcon\Mvc\Router\Group
{

    public function initialize()
    {
        $this->setPaths(array(
            'controller' => 'index'
        ));

        $this->add("/home", array(
            "action" => "index"
        ))->setName("home");
    }

}
