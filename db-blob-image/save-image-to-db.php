<?php
/* Save image from file to database */

/* GET filename and check it*/
$imageName = filter_input(INPUT_GET, 'img');
if (!$imageName || !file_exists("img/$imageName")) {
    die("No image or image does not exist. Use URL GET query: ?img=1.jpg");
}

/* connect to DB */
if (!($link = mysqli_connect("localhost", "root", "", "4it"))) {
    die("Unable to connect to DBMS.");
}
mysqli_query($link, 'SET CHARACTER SET UTF8');

/* load the image */
$imageFile = fopen("img/$imageName", 'rb');
if (!$imageFile) {
    die("The image was not opened.");
}
$data = fread($imageFile, filesize("img/$imageName"));
fclose($imageFile);
if (!$data) {
    die("No content in file.");
}
/* save image data to db */
$data = mysqli_real_escape_string($link, $data);
if (mysqli_query($link, "INSERT INTO image (`data`) VALUES ('$data')")) {
    echo 'The image has been saved to the DB. Id is ' . mysqli_insert_id($link) . '.';
} else {
    echo mysqli_error($link);
}
mysqli_close($link);
