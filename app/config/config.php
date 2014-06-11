<?php

return new \Phalcon\Config(array(
    'database'    => array(
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname'   => 'uld'
    ),
    'application' => array(
        'controllersDir' => APP_DIR . '/controllers/',
        'modelsDir'      => APP_DIR . '/models/',
        'formsDir'       => APP_DIR . '/forms/',
        'viewsDir'       => APP_DIR . '/views/',
        'libraryDir'     => APP_DIR . '/libraries/',
        'cacheDir'       => APP_DIR . '/cache/',
        'routeDir'       => APP_DIR . '/config/routes/',
        'validatorsDir'  => APP_DIR . '/validators/',
        'vendorDir'      => BASE_DIR . '/vendor/',
        'baseUri'        => '/',
        'publicUrl'      => 'localhost',
        'cryptSalt'      => 'YKaCEjaODSyMawu-WggW/pvq1orBqYFNEYXUUlDR$B!)0cu@1d2o69)sv5F$l+Q+',
        'saltBytes'      => 12
    ),
    'environment' => array(
        'development' => true,
        'debug'       => true
    )
        ));
