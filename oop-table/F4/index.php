<?php
require_once "Table.php";

echo (new Table)
    ->setClass("table-bordered")
    ->setCaption("Spotřeba ovoce")
    ->setCols(["name" => "Člověk", "pear" => "Hrušek"])
    ->loadData("data.json");
