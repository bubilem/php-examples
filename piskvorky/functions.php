<?php

/**
 * Html kód pro hráče X nebo O
 *
 * @param string $player
 * @return void
 */
function playerToHtml(string $player): string
{
    return '<b>' . ($player == 'X' ? '&#9587;' : '&#9711;') . '</b>';
}

/**
 * Zobrazení hracího pole v podobě tabulky
 *
 * @param bool $gameOver
 * @return void
 */
function showTable()
{
    echo '<table>';
    for ($y = 1; $y <= SIZE; $y++) {
        echo '<tr>';
        for ($x = 1; $x <= SIZE; $x++) {
            echo '<td>';
            if (!empty($_SESSION['playground'][$x][$y])) {
                echo playerToHtml($_SESSION['playground'][$x][$y]);
            } else if (!$_SESSION['game_over']) {
                echo '<a href="index.php?x=' . $x . '&y=' . $y . '"></a>';
            }
            echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

/**
 * Test je-li souřadnice [x,y] uvnitř herního pole
 *
 * @param int $x
 * @param int $y
 * @return bool
 */
function inside_playground(int $x, int $y): bool
{
    return !empty($x) && !empty($y) && $x >= 1 && $x <= SIZE && $y >= 1 && $y <= SIZE;
}

/**
 * Test, zdali na souřadnici [x,y hrál hráč
 *
 * @param int $x
 * @param int $y
 * @param [type] $player
 * @return bool
 */
function cast_in_playground(int $x, int $y, $player = null): bool
{
    return inside_playground($x, $y)
        && !empty($_SESSION['playground'][$x][$y])
        && ($player === null ? true : $_SESSION['playground'][$x][$y] == $player);
}

/**
 * Kontrola, zdali hráč tahem na [x,y] nevyhrál
 * Od [x,y] procházíme všemi směry a hledáme stejné sousedy 
 *
 * @param int $player_x
 * @param int $player_y
 * @return bool
 */
function check_win(int $player_x, int $player_y)
{
    if (!cast_in_playground($player_x, $player_y, $_SESSION['player'])) {
        return;
    }
    $player = $_SESSION['playground'][$player_x][$player_y];
    //jakými směry chceme provádět kontrolu
    $move_to = [
        [[0, 1], [0, -1]], //nahoru a dolů
        [[-1, 0], [1, 0]], //vlevo a vpravo
        [[-1, -1], [+1, +1]], //vlevo-nahoru a vpravo-dolů
        [[+1, -1], [-1, +1]] //vpravo-nahoru a vlevo-dolů
    ];
    foreach ($move_to as $directions) { //pro všechny směry
        $neighbors = 0;
        foreach ($directions as $direction) {
            $x = $player_x + $direction[0];
            $y = $player_y + $direction[1];
            while (cast_in_playground($x, $y, $player)) {
                $neighbors++;
                $x += $direction[0];
                $y += $direction[1];
            }
        }
        if ($neighbors + 1 >= $_SESSION['to_win']) {
            $_SESSION['game_over'] = true;
            echo '<p>Vyhrál hráč ' . playerToHtml($player) . '.</p>';
        }
    }
}
