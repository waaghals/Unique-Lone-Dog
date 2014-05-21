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

        $this->addGet("/group", array(
            "action" => "index"
        ))->setName("group");

        $this->add("/group/subscribe/{id}/", array(
            "action" => "performSubscribeGroup"
        ))->setName("group-subscribe");

        $this->add("/group/unsubscribe/{id}/", array(
            "action" => "performUnsubscribeGroup"
        ))->setName("group-unsubscribe");

        $this->add("/group/explore", array(
            "action" => "exploreGroup"
        ))->setName("group-explore");

        $this->addGet("/group/add", array(
            "action" => "AddGroupForm"
        ))->setName("group-add");

        $this->addPost("/group/add", array(
            "action" => "performAddGroup"
        ));
    }

}
