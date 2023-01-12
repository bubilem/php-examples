<?php
require_once "Table.php";
require_once "TableLoader.php";

$table = (new TableLoader)
    ->load("conf.json")
    ->getTable();

echo $table("json");
echo $table("html");

echo (new TableLoader)
    ->load("conf.json")
    ->getTable()("html");
