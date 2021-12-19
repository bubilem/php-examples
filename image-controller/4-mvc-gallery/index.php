<?php
error_reporting(E_ALL);
mb_internal_encoding("UTF-8");

/* konfigurace */
define("APP_DIR", 'app/');
define("DATA_DIR", 'data/');
define("URL", 'http://www/'); //nebo třeba http://127.0.0.1/
define("URL_DIR", 'php-examples/image-controller/4-mvc-gallery/'); // podsložka projektu

/* autoloader pro třídy */
spl_autoload_register(function (string $className) {
    $path = APP_DIR . 'utils';
    foreach ([
        'Controller' => APP_DIR . 'controllers',
        'Model' => APP_DIR . 'models',
        'View' => APP_DIR . 'views'
    ] as $classTypeName => $classTypeDirectory) {
        if (preg_match('~.*' . $classTypeName . '$~', $className)) {
            $path = $classTypeDirectory;
            break;
        }
    }
    $path .= '/' . $className . '.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        exit("Class $className not found!");
    }
});

/* spuštění aplikace */
(new RouterController())->run();
