<?php
require_once "Table.php";
require_once "TableLoader.php";

echo (new TableLoader)->load("conf.json")->getTable();
