<?php

define("URL", "http://www");
define("URL_DIR", "/php-examples/url-router/03-template/");
define("PAGES_DIR", "pages/");
define("URI", str_replace(URL_DIR, "", $_SERVER["REQUEST_URI"]));
$uriParam = explode("/", URI);
