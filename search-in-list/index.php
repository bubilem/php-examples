<?php
require_once "autoload.php";

/* configuration */
$itemCount = 10000;
$itemMinVal = 0;
$itemMaxVal = 999;
$searchCount = 100000;

/* list selection */
//$l = new SimpleList();
$l = new OrderedList();
//$l = new IndexList();

Timer::start();

/* generating items */
for ($i = 0; $i < $itemCount; $i++) {
    $rndVal = mt_rand($itemMinVal, $itemMaxVal);
    $l->add($rndVal);
}

Timer::check("Gene: ");

/* search in items */
for ($i = 0; $i < $searchCount; $i++) {
    $l->exists(mt_rand($itemMinVal, $itemMaxVal));
}

Timer::check("Srch: ");
