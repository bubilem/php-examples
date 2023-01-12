<?php
require_once "Table.php";

echo Table::toHtml(
    "Spotřeba ovoce",
    "table-bordered",
    ["name" => "Člověk", "pear" => "Hrušek"],
    [
        ["name" => "Michal", "apple" => 5, "pear" => 8],
        ["name" => "Emil", "apple" => 10, "pear" => 1]
    ]
);
