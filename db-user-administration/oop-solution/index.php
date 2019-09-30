<?php
/* Show all type errors, warnings, notices... */
error_reporting(E_ALL);

/* Load configuration */
require_once('conf.php');

/* UTF-8 string encoding */
mb_internal_encoding("UTF-8");

/* Class loader include */
require_once('utils/Loader.php');

/* Regiter the function for autoloading the classes */
spl_autoload_register('Loader::loadClass');

/* Run the page app */
PageController::create()->run();
