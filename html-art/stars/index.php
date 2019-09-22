<?php
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Stars</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <?php

        $canvas = [];
        $starCount = mt_rand(5, 25);
        for ($i = 1; $i <= $starCount; $i++) {
            star($canvas, mt_rand(10, 90), mt_rand(10, 90), mt_rand(1, 16), mt_rand(3, 12));
        }

        for ($y = 1; $y <= 100; $y++) {
            for ($x = 1; $x <= 100; $x++) {
                if (!empty($canvas[$x][$y])) {
                    echo '<div style="background-color:' . $canvas[$x][$y] . '"></div>';
                } else {
                    $rgba = "rgba(0,0,0," . round(mt_rand(1, 50) / 100, 2) . ")";
                    echo '<div style="background-color:' . $rgba . '"></div>';
                }
            }
        }

        function star(&$canvas, $x, $y, $size, $streaks)
        {
            $rgb = generateRGB();
            for ($r = 0; $r < $size; $r++) {
                for ($i = 1; $i <= $streaks; $i++) {
                    $fi = $i * (2 * M_PI / $streaks);
                    $rgba = "rgba($rgb," . round(1 - ($r) / $size, 2) . ")";
                    $canvas[$x + $r * cos($fi)][$y + $r * sin($fi)] = $rgba;
                }
            }
        }

        function generateRGB()
        {
            switch (mt_rand(1, 10)) {
                case 1:
                case 2:
                case 3:
                    return "255,255," . mt_rand(100, 222);
                case 4:
                    $color = mt_rand(100, 222);
                    return "255," . $color . "," . $color;
                case 5:
                    $color = mt_rand(200, 255);
                    return $color . "," . $color . ",255";
                default:
                    $color = mt_rand(150, 255);
                    return $color . "," . $color . "," . $color;
            }
        }

        ?>
    </main>
</body>

</html>