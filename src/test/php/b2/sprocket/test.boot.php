<?php

if (array_key_exists('b2foundation', $GLOBALS)) {
    return;
}

//
//  Settings
//

// todo DEFFERED extract to test config
$GLOBALS['b2foundation'] = 'C:\Work\Axiomus\foundation\src\main\php';
//$GLOBALS['b2tmp'] = 'C:\tmp\fastframework-dev\tmp';
define('B2_TEST_RESOURCES', 'C:\Work\Axiomus\foundation\src\test\resources');

require_once 'C:\Work\Axiomus\foundation\src\main\php\b2\sys\classloading.php';
b2classpath('C:\Work\Axiomus\sprocket-axiomus\src\main\php');

//
//  Script
//

//require_once $GLOBALS['b2foundation'] . "/b2/sys/classloading.php";
b2classpath($GLOBALS['b2foundation']);
//b2_class_autoload_register();

require_once __DIR__ . '/test.functions.php';
/*
\b2\logging\LogFactory::setLogManager(new \b2\logging\LogManager(
    array(
        'logging' => true,
        'settings' => array(
            'file' => b2tmp('b2log.txt'),
            'level' => 'TRACE',
            'format' => '%d [%p] %c (%l) %m%n'
        )
    )
));*/