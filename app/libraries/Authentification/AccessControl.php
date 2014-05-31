<?php

/*
 * The MIT License
 *
 * Copyright 2014 Patrick.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace UniqueLoneDog\Authentification;

use Phalcon\Events\Event,
    Phalcon\Mvc\User\Plugin,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Acl,
    Phalcon\Acl\Adapter\Memory as AclMemory,
    Phalcon\Acl\Resource as AclResource,
    Phalcon\Acl\Role as AclRole;
use UniqueLoneDog\Models\Role,
    UniqueLoneDog\Models\Permission;

/**
 * AccessControl
 *
 * AccessControl plugin which controls that users only have access to controllers they're assigned to
 */
class AccessControl extends Plugin
{

    public function __construct($di)
    {
        $this->di = $di;
    }

    public function getAcl()
    {
        $acl = new AclMemory();

        $acl->setDefaultAction(Acl::DENY);

        // Register roles
        $roles       = Role::find(array(
                    "order" => "power ASC"
        ));
        $permissions = Permission::find();

        foreach ($permissions as $permission) {
            $acl->addResource(new AclResource($permission->controller), $permission->action);
        }



        // Grant permissions in "permissions" model
        foreach ($permissions as $permission) {

            $acl->addRole(new AclRole($permission->role->name));
            $acl->allow($permission->role->name, $permission->controller, $permission->action);

            foreach ($roles as $role) {

                if ($role->power > $permission->role->power) {
                    $acl->addRole(new AclRole($role->name));
                    $acl->allow($role->name, $permission->controller, $permission->action);
                }
            }
        }
        return $acl;
    }

    /**
     * This action is executed before execute any action in the application
     */
    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        $role = 'Guest';
        if ($this->identity->exists()) {
            $identity = $this->identity->getIdentity();
            $role     = $identity['role'];
        }

        $controller = $dispatcher->getControllerName();
        $action     = $dispatcher->getActionName();

        $acl = $this->getAcl();

        $allowed = $acl->isAllowed($role, $controller, $action);

        if ($allowed != Acl::ALLOW) {
            $this->forwardHome($dispatcher);
            return false;
        }
    }

    private function forwardHome(Dispatcher $dispatcher)
    {
        $this->flashSession->error("You don't have access to this module");
        $dispatcher->forward(
                array(
                    'controller' => 'index',
                    'action'     => 'index'
                )
        );
    }

}
