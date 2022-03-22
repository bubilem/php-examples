<?php
require __DIR__ . "/../utils/_init.php";

$vendorCount = 50;

for ($i = 1; $i <= $vendorCount; $i++) {
    DB::query(
        "INSERT INTO vendor (name, products) VALUES ('" . Gene::name() . "', 0)"
    );
}

Stopwatch::stop();
