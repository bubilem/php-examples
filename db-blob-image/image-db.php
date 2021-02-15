<?php
/* Load image from database to image file on the fly */

if (!($link = @mysqli_connect("localhost", "root", "", "4it"))) {
    die("Unable to connect to DBMS.");
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if ($id) {
    mysqli_query($link, 'SET CHARACTER SET UTF8');
    $result = mysqli_query($link, "SELECT `id`, `data` FROM image WHERE id = $id");
    $image = mysqli_fetch_assoc($result);
    header('Content-Type: image/jpeg');
    echo $image['data'];
}
mysqli_close($link);
