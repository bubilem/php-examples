<?php
$pages = [
    "home" => "Super firma",
    "produkty" => "Naše produkty",
    "kontakty" => "Jak nás kontaktovat",
    "404" => "Ups 404"
];
$url = "http://www";
$urlDir = "/php-examples/url-router/03-template/";
$uri = str_replace($urlDir, "", $_SERVER["REQUEST_URI"]);
$uriParam = explode("/", $uri);
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
$pageTemplate = str_replace("{base}", $url . $urlDir, $pageTemplate);
$pageTemplate = str_replace("{title}", $title, $pageTemplate);
$pageTemplate = str_replace("{navigation}", $navigation, $pageTemplate);
$pageTemplate = str_replace("{content}", $content, $pageTemplate);
echo $pageTemplate;
