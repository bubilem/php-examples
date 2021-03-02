<?php
session_start();
define('SIZE', 10);
require_once "functions.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Piškvorky</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <h1>Piškvorky PVE <sup><small>NOOB "AI"</small></sup></h1>
        <?php
        echo '<p><a href="index.php?action=new">Nová hra</a></p>';

        //reset pro novou hru
        if (filter_input(INPUT_GET, 'action') == 'new') {
            session_unset();
            $_SESSION['game_over'] = false; //default
        }
        if (isset($_SESSION['game_over'])) {
            //souřadnice ze vstupu
            $x = intval(filter_input(INPUT_GET, 'x'));
            $y = intval(filter_input(INPUT_GET, 'y'));
            //je korektní tah?
            if (inside_playground($x, $y) && !cast_in_playground($x, $y)) {
                $_SESSION['playground'][$x][$y] = 'X'; //zapis tah
                check_win($x, $y, 'X'); //zkontroluj výhru
                ai_play();
            }
            //ukaž herní pole
            showTable();
            echo '<p><small>vítězství na <b>5</b> v řadě všemi směry</small></p>';
            if ($_SESSION['game_over']) {
                session_unset();
            }
        }
        ?>
    </main>
</body>

</html>