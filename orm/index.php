<?php
spl_autoload_register(function (string $className) {
    if (file_exists("class/$className.php")) {
        require "class/$className.php";
    } else {
        die("Unable to load class $className.");
    }
});

$mess = new MessageModel();
$mess->setContent("Random number " . mt_rand(1, 99));
var_dump($mess);
var_dump($mess->save());
var_dump($mess);
var_dump($mess->delete());
var_dump($mess);

/*
$mess = new MessageModel();
$mess->setContent("Random number " . mt_rand(1, 99));
$mess->save();
*/

/*
$mess = new MessageModel(6);
$mess->setContent("Random number " . mt_rand(1, 99));
$mess->save();
*/
