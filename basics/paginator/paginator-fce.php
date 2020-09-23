<?php

paginator(100, 1);
echo '<br>';
paginator(500, 2, 15);
echo '<br>';
paginator(10, 3, 2);
echo '<br>';
paginator(20);

function paginator($countPage, $around = 4, $actPage = 1)
{
    $dots = false;
    for ($i = 1; $i <= $countPage; $i++) {
        if (
            $i == 1 || $i == $countPage ||
            ($i >= $actPage - $around && $i <= $actPage + $around)
        ) {
            echo $i != 1 && !$dots ? " " : "";
            echo ($i != $actPage) ? '<a href="#' . $i . '">' . $i . '</a>' : $i;
            $dots = false;
        } else {
            if (!$dots) {
                echo " ... ";
                $dots = true;
            }
        }
    }
}
