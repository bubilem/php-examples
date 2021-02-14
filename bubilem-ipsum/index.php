<?php
error_reporting(E_ALL);
mb_internal_encoding("UTF-8");
?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <title>Bubilem Ipsum</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="www/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <main>
        <article>
            <h1>Bubilem Ipsum</h1>
            <?php
            require_once "classes/Word.php";
            require_once "classes/Sentence.php";
            require_once "classes/Paragraph.php";
            Word::loadDictionary('general');
            echo '<blockquote>';
            echo new Paragraph(1);
            echo '- <cite>M. Bubílek (' . date("j. n. Y") . ')</cite>';
            echo '</blockquote>';
            $inputParagraphCount = filter_input(INPUT_GET, 'pcount', FILTER_SANITIZE_NUMBER_INT);
            $paragraphCount = $inputParagraphCount > 0 && $inputParagraphCount < 100 ? $inputParagraphCount : 3;
            for ($i = 1; $i <= $paragraphCount; $i++) {
                echo new Paragraph(mt_rand(10, 30));
            }
            ?>
            <a href="http://bubilem-ipsum.bubileg.cz">Generuj další bláboly</a>
        </article>
    </main>
</body>

</html>