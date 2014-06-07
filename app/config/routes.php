<?php

use UniqueLoneDog\Routes\AccountRoutes;
use UniqueLoneDog\Routes\IndexRoutes;
use UniqueLoneDog\Routes\ItemRoutes;
use UniqueLoneDog\Routes\GroupRoutes;

$router = new Phalcon\Mvc\Router();
$router->mount(new GroupRoutes());
$router->mount(new AccountRoutes());
$router->mount(new IndexRoutes());
$router->mount(new ItemRoutes());
return $router;
