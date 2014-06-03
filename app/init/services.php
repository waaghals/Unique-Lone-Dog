<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Crypt;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Files as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
use UniqueLoneDog\Authentification\Identity;
use UniqueLoneDog\Authentification\RememberMe;
use UniqueLoneDog\Authentification\Authentification;
use UniqueLoneDog\Random\Generator;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Register the global configuration as config
 */
$di->set('config', $config);

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
}, true);

/**
 * Setting up the view component
 */
$di->set('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($config) {

    $volt = new VoltEngine($view, $di);


    $volt->setOptions(array(
        'compiledPath'      => $config->application->cacheDir . 'volt/',
        'compiledSeparator' => '_',
        'compileAlways'     => $config->environment->development
    ));

    $compiler = $volt->getCompiler();
    $compiler->addFunction('is_class', function($obj, $name) {
        return is_subclass_of($obj, $name);
    });

    return $volt;
}
    ));

    return $view;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
    return new DbAdapter(array(
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname
    ));
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () use ($config) {
    return new MetaDataAdapter(array(
        'metaDataDir' => $config->application->cacheDir . 'metaData/'
    ));
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () {
    $session = new SessionAdapter();
    $session->start();
    return $session;
});

/**
 * Crypt service
 */
$di->set('crypt', function () use ($config) {
    $crypt = new Crypt();
    $crypt->setKey($config->application->cryptSalt);
    return $crypt;
});

/**
 * Dispatcher use a default namespace
 */
$di->set('dispatcher', function () {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('UniqueLoneDog\Controllers');
    return $dispatcher;
});

/**
 * Loading routes from the routes.php file
 */
$di->set('router', function () {
    return require APP_DIR . '/config/routes.php';
});

/**
 * Flash service with custom CSS classes
 */
$di->set('flash', function () {
    return new Flash(array(
        'notice'  => 'alert',
        'success' => 'alert alert-success',
        'warning' => 'alert alert-warning',
        'error'   => 'alert alert-danger'
    ));
});

$di->set("identity", function () {
    return new Identity();
});

$di->set("remember", function() {
    return new RememberMe();
});

$di->set("auth", function() {
    return new Authentification();
});

$di->set("random", function() {

    return new Generator();
});

$di->set('modelsManager', function() {
    return new Phalcon\Mvc\Model\Manager();
});
