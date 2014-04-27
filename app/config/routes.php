<?php

use UniqueLoneDog\Routes\AccountRoutes;

$router = new Phalcon\Mvc\Router();

$router->mount(new AccountRoutes());
return $router;
