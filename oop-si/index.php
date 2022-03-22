<?php

spl_autoload_register(function (string $className) {
    if (file_exists("app/$className.php")) {
        require "app/$className.php";
    } else {
        die("Unable to load class $className.");
    }
});

$circle = ShapeFactory::createUnitCircle();
var_dump($circle, $circle->getArea());
$circle->getCenter()->getPosition()->setX(10);
var_dump($circle, $circle->getArea());
