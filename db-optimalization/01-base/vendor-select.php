<?php
require __DIR__ . "/../utils/_init.php";

$result = DB::query(
    "SELECT v.name AS 'name', COUNT(p.id) AS 'products'
    FROM vendor AS v LEFT JOIN product AS p ON v.id = p.vendor_id
    WHERE products > 0
    GROUP BY v.id
    ORDER BY v.name"
);

while ($vendor = DB::fetch($result)) {
    printf(
        "%s (%s)\n",
        $vendor['name'],
        $vendor['products']
    );
}

Stopwatch::stop();
