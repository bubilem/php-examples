<?php
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Fibonacci</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <?php

        $canvas = [];
        fib($canvas);

        for ($y = 1; $y <= 100; $y++) {
            for ($x = 1; $x <= 100; $x++) {
                echo '<div' . (!isset($canvas[$x][$y]) ? ' class="bg"' : '') . '></div>';
            }
        }

        function fib(&$canvas)
        {
            $pre2 = 0;
            $fib = $pre1 = 1;
            $fi = 0;
            while ($fib < 200) {
                $x = 70 + round($fib / 2) * cos($fi);
                $y = 30 + round($fib / 2) * sin($fi);
                $canvas[$x][$y] = 1;
                $fi += M_PI / 4;
                $fib = $pre2 + $pre1;
                $pre2 = $pre1;
                $pre1 = $fib;
            }
        }

        ?>
    </main>
</body>

</html>