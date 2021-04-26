<?php

use BasicPHPUnitTest\geometry;

require __DIR__ . "/vendor/autoload.php";

$p = new geometry\Point(1, 0);
echo $p . "\n";
echo $p->getDistance(new geometry\Point(0, 0)) . "\n";
