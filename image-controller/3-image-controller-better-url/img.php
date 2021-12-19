<?php
$urlParams = explode('/', filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL));
$filename =  $urlParams[count($urlParams) - 2] . '.jpg';
$filetype = "image/jpeg";
if (strlen($filename) != 20 || !file_exists('img/' . $filename)) {
    $filename = 'no.png';
    $filetype = "image/png";
}
header("Pragma: cache");
header("Cache-Control: max-age=2592000"); //30days (60sec * 60min * 24hours * 30days)
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 2592000) . " GMT");
header("Keep-Alive: timeout=5, max=50");
header("Content-type: " . $filetype);
echo file_get_contents('img/' . $filename);
exit;
