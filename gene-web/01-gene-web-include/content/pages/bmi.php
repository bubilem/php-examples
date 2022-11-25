<?php
$h = filter_input(INPUT_POST, 'h', FILTER_SANITIZE_NUMBER_INT);
$m = filter_input(INPUT_POST, 'm', FILTER_SANITIZE_NUMBER_INT);
if ($h && $m) {
    echo '<h2>OK, něco jste zadali</h2>';
    echo "<ul><li>h = $h cm</li><li>m = $m kg</li>";
    $bmi = round($m / pow(($h / 100), 2), 2);
    echo "<li>Vaše BMI = $bmi</li></ul>";
    echo "<br>";
}

?>

<form action="index.php?p=bmi" method="POST">
    <div>
        h:<input type="number" name="h" value="180"> cm
    </div>
    <div>
        m:<input type="number" name="m" value="80"> kg
    </div>
    <div>
        <input type="submit" value="Vypočti">
    </div>
</form>