<?php
/* Save image from file to database */

if (!($link = mysqli_connect("localhost", "root", "", "database-name"))) {
    die("Unable to connect to DBMS.");
}
mysqli_query($link, 'SET CHARACTER SET UTF8');
$imageFile = fopen('image.jpg', 'rb');
$data = fread($imageFile, filesize('image.jpg'));
fclose($imageFile);
if ($data) {
    $data = mysqli_real_escape_string($link, $data);
    mysqli_query($link, "INSERT INTO image (`data`) VALUES ('$data')");
}
mysqli_close($link);
