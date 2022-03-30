<?php
require "conf.php";

require APP_DIR . "Loader.php";
spl_autoload_register('Loader::load');

Router::route(
    str_replace(URL_DIR, "", $_SERVER["REQUEST_URI"])
);
