<?php

namespace SimpleOrmExample;

use SimpleOrmExample\Model;

error_reporting(E_ALL);
mb_internal_encoding("UTF-8");

require_once('conf.php');
require_once(APP_PATH . 'Util/Loader.php');
spl_autoload_register('SimpleOrmExample\Util\Loader::loadClass');

$db = new Util\Database\DB();


/* Playing with models */

$city = new Model\City($db);
$city->load(1);
$city->setName("Varnsdorf")->setPopulation(16002);
//$city->setName("Horní Podluží")->setPopulation(698);
var_dump($city->save());

$region = new Model\Region($db);
$region->load(2);
var_dump($region->getName(), $region->name);
