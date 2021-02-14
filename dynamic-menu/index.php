<?php
/* load menu item counts from json */
$menuItemCounts = json_decode(file_get_contents("menu.json"), true);

/* load input GET */
$selectedItem = filter_input(INPUT_GET, 'item', FILTER_VALIDATE_INT);

/* if menu item was used */
if ($selectedItem && isset($menuItemCounts[$selectedItem])) {
    $menuItemCounts[$selectedItem]++;
    arsort($menuItemCounts);
    file_put_contents("menu.json", json_encode($menuItemCounts));
}

/* menu items */
$menuItems = [
    1 => "Item A",
    2 => "Item B",
    3 => "Item C",
    4 => "Item D",
    5 => "Item E"
];

/* menu generation */
echo '<nav><ul>';
foreach ($menuItemCounts as $key => $val) {
    echo '<li>';
    echo '<a href="?item=' . $key . '">' . $menuItems[$key] . '</a>';
    echo '</li>';
}
echo '</ul></nav>';
