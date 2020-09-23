<?php
require_once "class/AddressIPv4.php";
require_once "class/Network.php";
require_once "class/Message.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Adresování v jedné síti</title>
    <meta charset="UTF-8" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script src="script.js"></script>
</head>

<body>
    <main>
        <nav><a href="index.php">Zpět</a></nav>
        <h1>Adresování v jedné síti</h1>
        <form action="network.php" method="POST">
            <div>
                <label for="n1">Adresa&nbsp;sítě</label>
                <div>
                    <input id="n1" name="n1" type="number" min="0" max="255" step="1" oninput="maxLengthCheck(this,3)" value="<?php echo filter_input(INPUT_POST, "n1", FILTER_SANITIZE_NUMBER_INT); ?>"> .
                    <input name="n2" type="number" min="0" max="255" step="1" oninput="maxLengthCheck(this,3)" value="<?php echo filter_input(INPUT_POST, "n2", FILTER_SANITIZE_NUMBER_INT); ?>"> .
                    <input name="n3" type="number" min="0" max="255" step="1" oninput="maxLengthCheck(this,3)" value="<?php echo filter_input(INPUT_POST, "n3", FILTER_SANITIZE_NUMBER_INT); ?>"> .
                    <input name="n4" type="number" min="0" max="255" step="1" oninput="maxLengthCheck(this,3)" value="<?php echo filter_input(INPUT_POST, "n4", FILTER_SANITIZE_NUMBER_INT); ?>"> /
                    <input name="prefix" type="number" min="0" max="32" step="1" oninput="maxLengthCheck(this,2)" value="<?php echo filter_input(INPUT_POST, "prefix", FILTER_SANITIZE_NUMBER_INT); ?>">
                </div>
            </div>
            <div>
                <input type="submit" value="Vypočítej">
            </div>
        </form>

        <?php
        $prefix = filter_input(INPUT_POST, "prefix", FILTER_SANITIZE_NUMBER_INT);
        $ip = filter_input(INPUT_POST, "n1", FILTER_SANITIZE_NUMBER_INT) . "."
            . filter_input(INPUT_POST, "n2", FILTER_SANITIZE_NUMBER_INT) . "."
            . filter_input(INPUT_POST, "n3", FILTER_SANITIZE_NUMBER_INT) . "."
            . filter_input(INPUT_POST, "n4", FILTER_SANITIZE_NUMBER_INT);
        if ($prefix && $ip) {
            $net = new Network('TEST', new AddressIPv4($ip), $prefix);
            if ($net->isValid()) {
                $net->show();
                echo '<p>';
                foreach (['network', 'host', 'mixed'] as $val) {
                    echo '<span class="' . $val . '">' . $val . '</span> ';
                }
                echo '</p>';
            } else {
                Message::print("Chyba", "Špatně zadá adresa sítě.");
            }
        }

        ?>
    </main>
</body>

</html>