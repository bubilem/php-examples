<?php
require "conf.php";

require "app/Loader.php";
spl_autoload_register('Loader::load');

(new Router())->route(
    str_replace(URL_DIR, "", $_SERVER["REQUEST_URI"])
);
