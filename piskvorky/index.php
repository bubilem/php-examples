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
        <h1>Piškvorky</h1>
        <?php
        echo '<p>Nová hra: ';
        for ($i = 3; $i < 6; $i++) {
            echo ($i > 3 ? ', ' : '') . '<a href="index.php?action=new&to-win=' . $i . '">' . $i . '</a>';
        }
        echo '</p>';
        //reset pro novou hru
        if (filter_input(INPUT_GET, 'action') == 'new') {
            session_unset();
            $_SESSION['player'] = 'X'; //začíná křížek
            $_SESSION['game_over'] = false; //default
            $_SESSION['to_win'] = filter_input(INPUT_GET, 'to-win', FILTER_VALIDATE_INT);
            if (!in_array($_SESSION['to_win'], [3, 4, 5])) {
                $_SESSION['to_win'] = 3; //default
            }
        }
        if (isset($_SESSION['player'])) {
            //souřadnice ze vstupu
            $x = intval(filter_input(INPUT_GET, 'x'));
            $y = intval(filter_input(INPUT_GET, 'y'));
            //je korektní tah?
            if (inside_playground($x, $y) && empty($_SESSION['playground'][$x][$y])) {
                $_SESSION['playground'][$x][$y] = $_SESSION['player']; //zapis tah
                check_win($x, $y); //zkontroluj výhru
                $_SESSION['player'] = $_SESSION['player'] == 'X' ? 'O' : 'X'; //dalsi hrac

            }
            if (!$_SESSION['game_over']) {
                //hraje se, tak kdo je na tahu
                echo '<p>Na tahu je hráč: <b>' . playerToHtml($_SESSION['player']) . '</b></p>';
            }
            //ukaž herní pole
            showTable();
            echo '<p><small>vítězství na <b>' . $_SESSION['to_win'] . '</b> v řadě všemi směry</small></p>';
            if ($_SESSION['game_over']) {
                session_unset();
            }
        }
        ?>
    </main>
</body>

</html>