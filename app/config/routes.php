<?php

use UniqueLoneDog\Routes\AccountRoutes;
use UniqueLoneDog\Routes\IndexRoutes;

$router = new Phalcon\Mvc\Router();

$router->mount(new AccountRoutes());
$router->mount(new IndexRoutes());
return $router;
