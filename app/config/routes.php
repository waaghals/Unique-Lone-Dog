<?php

use UniqueLoneDog\Routes\AccountRoutes;
use UniqueLoneDog\Routes\IndexRoutes;
use UniqueLoneDog\Routes\GroupRoutes;

$router = new Phalcon\Mvc\Router();
$router->mount(new GroupRoutes());
$router->mount(new AccountRoutes());
$router->mount(new IndexRoutes());
return $router;
