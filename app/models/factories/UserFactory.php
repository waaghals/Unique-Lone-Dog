<?php

namespace UniqueLoneDog\Models\Factories;

use UniqueLoneDog\Models\User;
use UniqueLoneDog\Models\Status;
use UniqueLoneDog\Models\Role;
use Phalcon\DI\Injectable;

class UserFactory extends Injectable
{

    public function create($name, $email, $password)
    {
        $u         = new User();
        $u->email  = $email;
        $u->name   = $name;
        $u->status = Status::findFirstByName('non-confirmed');
        $u->role   = Role::findFirstByName('Users');
        $u->salt   = $this->security->getSaltBytes();

        $hash        = md5($u->salt + $password);
        $u->passhash = $hash;

        return $u;
    }

}
