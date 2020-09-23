<?php
require "C:data/development/www/php/work/class/Paginator.php";
$p1 = new Paginator(50);
$p2 = new Paginator(40, 1, 10);
echo $p1;
echo $p2;
