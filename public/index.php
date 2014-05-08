<?php

error_reporting(E_ALL);

try {

    /**
     * Define the BASE_DIR and APP_DIR constants
     */
    define('BASE_DIR', dirname(__DIR__));
    define('APP_DIR', BASE_DIR . '/app');

    /**
     * Read the configuration
     */
    $config = include APP_DIR . '/config/config.php';

    /**
     * Setup the autoloader
     */
    include APP_DIR . '/init/loader.php';

    /**
     * Setup the dependencies
     */
    include APP_DIR . '/init/services.php';

    /**
     * Kickstart the process
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();
} catch (Exception $e) {
    echo $e->getMessage(), '<br>';
    echo nl2br(htmlentities($e->getTraceAsString()));
}