<?php
/* unique shop ID */
$sid = 2345;

/* secret string - determined by the bank */
$secret = "d3b23ab1f35ab4c07cb3a6ed";

/* price - data to send */
$price = 5400;

echo "<h1>E-shop</h1>";
echo "<p>Amount to be paid: &dollar; " . number_format($price, 0, ',', '.') . "</p>";

/* unique sign generation */
$sign = hash("sha256", "$sid|$secret|$price");

/* url creation */
$url = "bank.php?price=$price&sid=$sid&sign=$sign";

/* Button with GET data - LINK */
echo '<p><a href="' . $url . '">Pay</a></p>';

/* Button with POST data - FORM */
echo '<form action="bank.php" method="POST">';
echo '<input type="hidden" name="sid" value="' . $sid . '">';
echo '<input type="hidden" name="price" value="' . $price . '">';
echo '<input type="hidden" name="sign" value="' . $sign . '">';
echo '<input type="submit" value="Pay">';
echo '</form>';
