<?php

namespace UniqueLoneDog\Controllers;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{

    public function indexAction()
    {
        $this->response->setContent("Hallo Wereld");
        $this->response->setStatusCode(501, "Not implemented");
        return $this->response;
    }

}
