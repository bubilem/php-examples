<?php
$pages = [
    "home" => "Super firma",
    "produkty" => "Naše produkty",
    "kontakty" => "Jak nás kontaktovat",
    "404" => "Ups 404"
];
$path = "/php-examples/url-router/02-cool-url/";
$uri = str_replace($path, "", $_SERVER["REQUEST_URI"]);
$uriParam = explode("/", $uri);
$p = $uriParam[0] ?? "";
if (empty($p)) {
    $p = 'home';
}
if (!isset($pages[$p])) {
    $p = '404';
}
?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <base href="http://www/php-examples/url-router/02-cool-url/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($p == "home" ? "" : $pages[$p] . " | ") . "Router"; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav>
            <?php
            foreach ($pages as $key => $val) {
                if ($key == "404") {
                    continue;
                }
                echo '<a ';
                if ($p == $key) {
                    echo 'class="active" ';
                }
                echo 'href="' . $key . '">' .
                    $val . '</a>';
            }
            ?>

        </nav>
    </header>
    <main>
        <?php
        include "pages/$p.php";
        ?>
    </main>
</body>

</html>