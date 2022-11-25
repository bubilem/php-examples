<?php
$p = filter_input(INPUT_GET, 'p');
$pages = [
    'home' => "Toto je Firma!",
    'sluzby' => "Naše služby",
    'kontakty' => "Kontakty",
    '404' => "Page not found",
    'random' => "Náhodné číslo",
    'bmi' => "Body Mass Index",
    'cont' => "Boxy v kontejneru",
    'gallery' => "Galerie"
];
if (empty($p)) {
    $p = 'home';
} else if (!isset($pages[$p])) {
    $p = '404';
}
