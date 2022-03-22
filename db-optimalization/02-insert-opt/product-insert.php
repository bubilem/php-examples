<?php
require __DIR__ . "/../utils/_init.php";

$insertCount = 1000;
$productsInOneInsert = 400;
$vendorCount = 100;

for ($i = 1; $i <= $insertCount; $i++) {
    $products = "";
    for ($j = 1; $j <= $productsInOneInsert; $j++) {
        $products .= ($j != 1 ? ", " : "") . "('" .
            Gene::name() . "', " .
            Gene::price() . ", " .
            random_int(1, $vendorCount) . ")";
    }
    DB::query(
        "INSERT INTO product (name, price, vendor_id) " .
            "VALUES " . $products
    );
}

Stopwatch::stop();
