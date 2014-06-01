<?php

namespace UniqueLoneDog\Controllers;

use Phalcon\Mvc\Controller;
use UniqueLoneDog\Models\User;

class IndexController extends Controller
{

    public function indexAction()
    {

    }

    public function testAction()
    {
        $user      = $this->identity->getUser();
        $otherUser = User::findFirst(3);
        var_dump($user->getReputation());
        $user->increaseReputation(100, $otherUser);
    }

}
