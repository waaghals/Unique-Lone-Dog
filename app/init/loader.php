<?php

$loader = new \Phalcon\Loader();

/**
 * Register the namespaces with the directories from the config
 */
$loader->registerNamespaces(array(
    'UniqueLoneDog\Models' => $config->application->modelsDir,
    'UniqueLoneDog\Controllers' => $config->application->controllersDir,
    'UniqueLoneDog\Forms' => $config->application->formsDir,
    'UniqueLoneDog\Routes' => $config->application->routeDir,
    'UniqueLoneDog\Validators' => $config->application->validatorsDir,
    'UniqueLoneDog' => $config->application->libraryDir,
    'UniqueLoneDog\Forms' => $config->application->formsDir,
    'UniqueLoneDog\Routes' => $config->application->routeDir,
    'UniqueLoneDog' => $config->application->libraryDir,
    'PDW' => $config->application->vendorDir . "pdw"
));

$loader->register();
