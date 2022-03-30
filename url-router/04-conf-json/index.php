<?php
require "conf.php";
$pages = json_decode(file_get_contents(PAGES_DIR . "pages.json"), true);
$page = $uriParam[0] ?? "";
if (empty($page)) {
    $page = 'home';
}
if (!isset($pages[$page])) {
    $page = '404';
}
$title = ($page == "home" ? "" : $pages[$page] . " | ") . "URL Router";
$navigation = "";
foreach ($pages as $key => $val) {
    if ($key == "404") {
        continue;
    }
    $navigation .= '<a ' . ($page == $key ? 'class="active" ' : '') . 'href="' . $key . '">' . $val . '</a>';
}
$content = file_get_contents("pages/$page.html");
$pageTemplate = file_get_contents("pages/page.html");
$pageTemplate = str_replace("{base}", URL . URL_DIR, $pageTemplate);
$pageTemplate = str_replace("{title}", $title, $pageTemplate);
$pageTemplate = str_replace("{navigation}", $navigation, $pageTemplate);
$pageTemplate = str_replace("{content}", $content, $pageTemplate);
echo $pageTemplate;
