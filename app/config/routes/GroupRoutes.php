<?php

namespace UniqueLoneDog\Routes;

/**
 * Holds the routes for the index controller
 *
 * @author Patrick
 */
class GroupRoutes extends \Phalcon\Mvc\Router\Group
{

    public function initialize()
    {

        $this->setPaths(array(
            'controller' => 'group'
        ));

        $this->add("/group", array(
            "action" => "index"
        ))->setName("group");

        $this->addGet("/group/add", array(
            "action" => "AddGroupForm"
        ))->setName("group-add");

        $this->addPost("/group/add", array(
            "action" => "performAddGroup"
        ));
    }

}
