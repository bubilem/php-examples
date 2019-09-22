<?php
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Circle</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <?php

        $canvas = [];
        circle($canvas, 50, 50, 40, 5); //head
        circle($canvas, 50, 50, 45, 12, M_PI, 2 * M_PI); //hair
        circle($canvas, 36, 41, 12, 3, M_PI, 2 * M_PI - .5); //left eyebrow
        circle($canvas, 37, 40, 6, 2); //left eye
        circle($canvas, 64, 41, 12, 3, M_PI + .5, 2 * M_PI); //right eyebrow
        circle($canvas, 63, 40, 6, 2); //right eye
        circle($canvas, 50, 55, 20, 7, 0 + .5, M_PI - .5); //mouth

        for ($y = 1; $y <= 100; $y++) {
            for ($x = 1; $x <= 100; $x++) {
                echo '<div' . (!isset($canvas[$x][$y]) ? ' class="bg"' : '') . '></div>';
            }
        }

        function circle(&$canvas, $x, $y, $radius, $thickness, $fiStart = 0, $fiEnd = 2 * M_PI)
        {
            for ($t = 0; $t < $thickness; $t++) {
                for ($fi = $fiStart; $fi < $fiEnd; $fi += .01) {
                    $canvas[$x + ($radius - $t) * cos($fi)][$y + ($radius - $t) * sin($fi)] = 1;
                }
            }
        }

        ?>
    </main>
</body>

</html>