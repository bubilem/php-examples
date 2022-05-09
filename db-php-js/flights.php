<?php
date_default_timezone_set('Europe/Prague');
$csv = explode("\n", file_get_contents("data/flights.csv"));
$data = [];
foreach ($csv as $row) {
    $items = str_getcsv($row, ";");
    if (strtotime($items[1] . ' ' . $items[2]) >= time() - 60) {
        $data[] = [
            'type' => $items[0],
            'dttm' => date("d.m H:i", strtotime($items[1] . ' ' . $items[2])),
            'destination' => $items[3],
        ];
        if (count($data) == 3) {
            break;
        }
    }
}
echo json_encode($data);
