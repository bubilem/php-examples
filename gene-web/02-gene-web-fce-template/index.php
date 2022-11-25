<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="containers">
        <?php
        $count = 3;
        for ($i = 0; $i < $count; $i++) {
            echo tmplt("container", [
                "{caption}" => hello(),
                "{text}" => mt_rand(100, 999)
            ]);
        }

        $menu = json_decode(file_get_contents("data/menu.json"), true);
        foreach ($menu as $url => $cap) {
            echo tmplt(
                "a",
                ["{url}" => $url, "{caption}" => $cap]
            );
        }

        ?>
    </div>

</body>

</html>

<?php

function hello(int $key = null): string
{
    $p = ["Ahoj", "Čau", "Hello", "Hi", "Čao", "Joha", "Hola", "Nazdar", "Čest", "Čus"];
    if ($key === null || $key < 0 || $key >= count($p) - 1) {
        $key =  mt_rand(0, count($p) - 1);
    }
    return $p[$key];
}

function tmplt(string $filename, array $data): string
{
    if (!file_exists("tmplt/" . $filename . ".html")) {
        return "";
    }
    $content = file_get_contents("tmplt/" . $filename . ".html");
    foreach ($data as $key => $value) {
        $content = str_replace($key, $value, $content);
    }
    return $content;
}
