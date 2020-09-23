<?php
require  dirname($_SERVER['SCRIPT_FILENAME']) . "\class\Paginator.php";

$p = new Paginator(50, 2);
echo $p->render();

$p->setActualPage(10)->echo();

$p->setActualPage(20);
echo $p;
