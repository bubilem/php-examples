<?php
spl_autoload_register(function (string $className) {
    if (file_exists("class/$className.php")) {
        require "class/$className.php";
    } else {
        die("Unable to load class $className.");
    }
});
