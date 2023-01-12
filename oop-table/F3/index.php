<?php
require_once "Table.php";

$table = new Table();
$table->setClass("table-bordered");
$table->setCaption("Spotřeba ovoce");
$table->setCols(["name" => "Člověk", "pear" => "Hrušek"]);
$table->setData([
    ["name" => "Michal", "apple" => 5, "pear" => 8],
    ["name" => "Emil", "apple" => 10, "pear" => 1]
]);
echo $table->toHtml();
$table->setCaption("Seznam lidí");
$table->setCols(["name" => "Člověk"]);
echo $table->toHtml();
