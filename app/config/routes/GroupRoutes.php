<?php

namespace UniqueLoneDog\Routes;

/**
 * Holds the routes for the group controller
 *
 * @author Jelle
 */
class GroupRoutes extends \Phalcon\Mvc\Router\Group
{

    public function initialize()
    {

        $this->setPaths(array(
            'controller' => 'group'
        ));

        $this->setPrefix('/group');

        $this->addGet("/", array(
            "action" => "index"
        ))->setName("group");

        $this->add("/subscribe/{id}/",
                   array(
            "action" => "performSubscribeGroup"
        ))->setName("group-subscribe");

        $this->add("/unsubscribe/{id}/",
                   array(
            "action" => "performUnsubscribeGroup"
        ))->setName("group-unsubscribe");

        $this->add("/explore",
                   array(
            "action" => "exploreGroup"
        ))->setName("group-explore");

        $this->addGet("/add",
                      array(
            "action" => "addGroupForm"
        ))->setName("group-add");

        $this->addPost("/add",
                       array(
            "action" => "performAddGroup"
        ));

        $this->addGet("/show/{slug}",
                      array(
            "action" => "show"
        ))->setName("group-show");

        $this->addGet("/edit/{slug}",
                      array(
            "action" => "edit"
        ))->setName("group-edit");
    }

}
