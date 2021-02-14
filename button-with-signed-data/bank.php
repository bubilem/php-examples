<?php
echo "<h1>Bank - payment gateway</h1>";
/* POST or GET receiving? */
if (isset($_POST['sid'])) {
    $inputMethod = INPUT_POST;
} else if (isset($_GET['sid'])) {
    $inputMethod = INPUT_GET;
} else {
    die("WTF?");
}

/* data loading */
$sid = filter_input($inputMethod, 'sid');
$price = filter_input($inputMethod, 'price', FILTER_VALIDATE_INT);
$sign = filter_input($inputMethod, 'sign');
$secret = "d3b23ab1f35ab4c07cb3a6ed";

/* data verification */
if ($sid && $sign && $price && $sign == hash("sha256", "$sid|$secret|$price")) {
    echo "<p>Amount to be paid: &dollar; " . number_format($price, 0, ',', '.') . "</p>";
} else {
    echo '<p>Error</p>';
}
echo '<a href="shop.php">Back to e-shop</a>';
