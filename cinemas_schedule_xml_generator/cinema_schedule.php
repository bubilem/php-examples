<?php

/**
 * Generating the cinema_schedule.xml file
 */

define("EOL", "\n");
header("Content-Type: application/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8" ?>' . EOL;
echo '<cinema_schedule>' . EOL;
echo tab(1) . '<cinemas>' . EOL;
$movies = json2array("movies");
foreach (json2array("cinemas") as $cinema) {
    echo tab(2) . '<cinema>' . EOL;
    echo tab(3) . '<code>' . $cinema['code'] . '</code>' . EOL;
    echo tab(3) . '<name>' . $cinema['name'] . '</name>' . EOL;
    echo tab(3) . '<city>' . $cinema['city'] . '</city>' . EOL;
    echo tab(3) . '<program>' . EOL;
    $date = new DateTime(date("Y-m-d"));
    $date->add(new DateInterval('P1D'));
    $endDate = new DateTime(date("Y-m-d"));
    $endDate->add(new DateInterval('P1M'));
    $show_times = ['14:00', '16:30', '19:00', '21:00'];
    while ($date <= $endDate) {
        $date->add(new DateInterval('P1D'));
        if (!in_array($date->format("w"), $cinema['days'])) {
            continue;
        }
        $time = mt_rand(0, 5);
        $step = mt_rand(1, 2);
        while ($time < count($show_times)) {
            echo tab(4) . '<show>' . EOL;
            echo tab(5) . '<date>' . $date->format("Y-m-d") . '</date>' . EOL;
            echo tab(5) . '<time>' . $show_times[$time] . '</time>' . EOL;
            $m = $movies[mt_rand(0, count($movies) - 1)];
            echo tab(5) . '<movie>' . EOL;
            echo tab(6) . '<name>' . $m['name'] . '</name>' . EOL;
            echo tab(6) . '<genres>' . EOL;
            foreach (explode('/', $m['genre']) as $genre) {
                echo tab(6) . tab() . '<genre>' . $genre . '</genre>' . EOL;
            }
            echo tab(6) . '</genres>' . EOL;
            echo tab(6) . '<countries>' . EOL;
            foreach (explode('/', $m['country']) as $country) {
                echo tab(6) . tab() . '<country>' . $country . '</country>' . EOL;
            }
            echo tab(6) . '</countries>' . EOL;
            echo tab(6) . '<published unit="year">' . $m['year'] . '</published>' . EOL;
            echo tab(6) . '<length unit="minutes">' . $m['length'] . '</length>' . EOL;
            echo tab(6) . '<mpaa>' . $m['mpaa'] . '</mpaa>' . EOL;
            echo tab(6) . '<price curr="CZK">' . (mt_rand(10, 20) * 10) . '</price>' . EOL;
            echo tab(5) . '</movie>' . EOL;
            echo tab(4) . '</show>' . EOL;
            $time += $step + mt_rand(0, 1);
        }
    }
    echo tab(3) . '</program>' . EOL;
    echo tab(2) . '</cinema>' . EOL;
}
echo tab(1) . '</cinemas>' . EOL;
echo tab(1) . '<outputs>' . EOL;
foreach (json2array("output") as $k => $v) {
    echo tab(2) . '<output code="' . $k . '">' . $v . '</output>' . EOL;
}
echo tab(1) . '</outputs>' . EOL;
echo '</cinema_schedule>' . EOL;

/**
 * Load json file to assoc array
 *
 * @param string $name filename withou dir and extension
 * @return array
 */
function json2array(string $name): array
{
    return json_decode(file_get_contents("data/$name.json"), true);
}

/**
 * Tab generator
 *
 * @param int $times
 * @return string
 */
function tab(int $times = 1): string
{
    return str_repeat("  ", $times);
}
