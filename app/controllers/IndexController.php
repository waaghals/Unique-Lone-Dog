<?php

namespace UniqueLoneDog\Controllers;

use Phalcon\Mvc\Controller;
use UniqueLoneDog\Models\MachineTag;

class IndexController extends Controller
{

    public function indexAction()
    {

    }

    public function testAction()
    {
        $tag = new MachineTag();
    }

}
