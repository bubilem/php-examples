<?php
spl_autoload_register(function (string $className) {
    if (file_exists("class/$className.php")) {
        require "class/$className.php";
    } else {
        die("Unable to load class $className.");
    }
});

/* create new message */
$mess = new MessageModel();
$mess->setContent("Random number " . mt_rand(1, 99));
$mess->save();


/* load existing message by id (PK), change and save */
$mess = new MessageModel(6);
$mess->setContent("Random number " . mt_rand(1, 99));
$mess->save();
