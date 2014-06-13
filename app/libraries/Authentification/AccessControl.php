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

    /**
     * Get the fully build access list
     *
     * @return \Phalcon\Acl\Adapter\Memory
     */
    private function getAccessList()
    {
        $roles       = Role::find(array(
                    "order" => "power ASC"
        ));
        $permissions = Permission::find();

        //TODO: Cache the result, and if it exists return that
        return $this->buildAccessList($permissions, $roles);
    }

    /**
     * Builds the access control list using the $permissions and $roles
     *
     * @param ResultSet<Permission> $permissions
     * @param ResultSet<Role> $roles
     * @return \Phalcon\Acl\Adapter\Memory
     */
    private function buildAccessList($permissions, $roles)
    {
        $acl = new AclMemory();
        $acl->setDefaultAction(Acl::DENY);
        foreach ($permissions as $permission) {
            $acl->addResource(new AclResource($permission->controller),
                                              $permission->action);

            foreach ($roles as $role) {

                if ($role->power >= $permission->role->power) {
                    $acl->addRole(new AclRole($role->name));
                    $acl->allow($role->name, $permission->controller,
                                $permission->action);
                }
            }
        }

        return $acl;
    }

    /**
     * This action is executed before execute any action in the application
     *
     * @param \Phalcon\Events\Event $event
     * @param \Phalcon\Mvc\Dispatcher $dispatcher
     * @return boolean
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

        $acl = $this->getAccessList();

        $allowed = $acl->isAllowed($role, $controller, $action);

        if ($allowed != Acl::ALLOW) {
            $this->flashSession->error(sprintf("You don't have access to %s::%s()",
                                               $controller, $action));
            $this->forwardHome($dispatcher);
            return false;
        }
    }

    /**
     * Show an error and show the user the result of index/index
     *
     * @param \Phalcon\Mvc\Dispatcher $dispatcher
     */
    private function forwardHome(Dispatcher $dispatcher)
    {

        $dispatcher->forward(
                array(
                    'controller' => 'index',
                    'action'     => 'index'
                )
        );
    }

}
