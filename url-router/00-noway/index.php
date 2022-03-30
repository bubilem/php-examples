<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Router</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav>
            <a href="?p=pages/home.html">Domů</a>
            <a href="?p=pages/produkty.html">Produkty</a>
            <a href="?p=pages/kontakty.html">Kontakty</a>
        </nav>
    </header>
    <main>
        <?php
        $p = $_GET['p'] ?? 'pages/home.html';
        if (empty($p) || !file_exists($p)) {
            $p = 'pages/404.html';
        }
        include $p;
        ?>
    </main>
</body>

</html>