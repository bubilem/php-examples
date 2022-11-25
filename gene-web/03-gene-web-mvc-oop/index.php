<?php

// načtení automatického loaderu souborů tříd 
require_once "app/util/Loader.php";
spl_autoload_register("Loader::loadClass");

//spuštění routeru, který určí dle URI hlavní oblužný controller
try {
    (new Router)->route($_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    die($e->getMessage());
}
