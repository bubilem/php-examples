<?php
$cols = ["name" => "Člověk", "apple" => "Jablek"];
$data = [
    ["name" => "Michal", "apple" => 5, "pear" => 8],
    ["name" => "Emil", "apple" => 10, "pear" => 1]
];

echo "<table class=\"table-bordered\">" . PHP_EOL;
echo "<caption>Spotřeba ovoce</caption>" . PHP_EOL;
echo "<tr>";
foreach ($cols as $col) {
    echo "<th>$col</th>";
}
echo "</tr>" . PHP_EOL;
foreach ($data as $row) {
    echo "<tr>";
    foreach ($cols as $key => $name) {
        echo "<td>" . (!isset($row[$key]) ? "" : $row[$key]) . "</td>";
    }
    echo "</tr>" . PHP_EOL;
}
echo  "</table>" . PHP_EOL;
