<?php
$pages = [
    "home" => "Super firma",
    "produkty" => "Naše produkty",
    "kontakty" => "Jak nás kontaktovat",
    "404" => "Ups 404"
];
$p = filter_input(INPUT_GET, 'p');
if (empty($p)) {
    $p = 'home';
}
if (!isset($pages[$p])) {
    $p = '404';
}
$title = $pages[$p];
?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title . ($title ? " | " : "") . "Router"; ?></title>
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
                echo 'href="?p=' . $key . '">' .
                    $val . '</a>';
            }
            ?>

        </nav>
    </header>
    <main>
        <h1><?php echo $title; ?></h1>
        <?php
        include "app/$p.php";
        ?>
    </main>
</body>

</html>