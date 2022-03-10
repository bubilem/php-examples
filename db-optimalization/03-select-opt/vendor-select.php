<?php
require __DIR__ . "/../utils/_init.php";

$result = DB::query(
    "SELECT name, products FROM vendor WHERE products > 0 ORDER BY name"
);

while ($vendor = DB::fetch($result)) {
    printf(
        "%s (%s)\n",
        $vendor['name'],
        $vendor['products']
    );
}

Stopwatch::stop();
