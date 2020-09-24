<?php
$divident = filter_input(INPUT_GET, 'divident', FILTER_SANITIZE_NUMBER_INT);
$divisor = filter_input(INPUT_GET, 'divisor', FILTER_SANITIZE_NUMBER_INT);
if ($divident == null || $divisor == null || $divisor == 0) {
    echo '<p>Wrong input.</p>';
} else {
    $remainder = $divident;
    while ($remainder >= $divisor) {
        $remainder = $remainder - $divisor;
    }
    echo "<p>$divident mod $divisor = $remainder<p>";
    echo "<p>Check:<br>($divisor &times; " . floor($divident / $divisor) . ") + $remainder  = $divident<p>";
}

echo '<table>';
for ($y = 0; $y < floor($divident / $divisor); $y++) {
    echo '<tr>';
    for ($x = 0; $x < $divisor; $x++) {
        echo '<td>';
        if (($x + $y) % 2) {
            echo '&#x26AA;';
        } else {
            echo '&#x26AB;';
        }
        echo '</td>';
    }
}
if ($remainder) {
    echo '<tr>';
    for ($x = 0; $x < $remainder; $x++) {
        echo '<td>';
        if (($x + $y) % 2) {
            echo '&#x26AA;';
        } else {
            echo '&#x26AB;';
        }
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';
