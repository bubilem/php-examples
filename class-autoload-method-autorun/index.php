<?php

/* register anonymous autoload function */
spl_autoload_register(function (string $className) {
    if (file_exists("class/$className.php")) {
        require "class/$className.php";
    } else {
        die("Unable to load class $className.");
    }
});

/*
Get parammeter from URL and transform it to camel case class name
Example:
    home -> Home
    say-hello-friend -> SayHelloFriend
*/
$className = str_replace("-", "", ucwords(filter_input(INPUT_GET, 'p'), "-"));

/* create instance of class */
$object = new $className();

/* run method run() if exists */
if (method_exists($object, 'run')) {
    $object->run();
}
