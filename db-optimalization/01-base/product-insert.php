<?php
require __DIR__ . "/../utils/_init.php";

$productCount = 1000;
$vendorCount = 50;

for ($i = 1; $i <= $productCount; $i++) {
    DB::query(
        "INSERT INTO product (name, price, vendor_id) " .
            "VALUES ('" .
            Gene::name() . "', " .
            Gene::price() . ", " .
            random_int(1, $vendorCount) . ")"
    );
}

Stopwatch::stop();
