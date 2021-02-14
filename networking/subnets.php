<?php
require_once "class/AddressIPv4.php";
require_once "class/Network.php";
require_once "class/Message.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Adresování s maskou podsítě pevné délky</title>
    <meta charset="UTF-8" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script src="script.js"></script>
</head>

<body>
    <main>
        <nav><a href="index.php">Zpět</a></nav>

        <h1>Adresování s maskou podsítě pevné délky</h1>
        <form action="subnets.php" method="POST">
            <div>
                <label for="n1">Vstupní&nbsp;rozsah</label>
                <div>
                    <input id="n1" name="n1" type="number" min="0" max="255" step="1" oninput="maxLengthCheck(this,3)" value="<?php echo filter_input(INPUT_POST, "n1", FILTER_SANITIZE_NUMBER_INT); ?>"> .
                    <input name="n2" type="number" min="0" max="255" step="1" oninput="maxLengthCheck(this,3)" value="<?php echo filter_input(INPUT_POST, "n2", FILTER_SANITIZE_NUMBER_INT); ?>"> .
                    <input name="n3" type="number" min="0" max="255" step="1" oninput="maxLengthCheck(this,3)" value="<?php echo filter_input(INPUT_POST, "n3", FILTER_SANITIZE_NUMBER_INT); ?>"> .
                    <input name="n4" type="number" min="0" max="255" step="1" oninput="maxLengthCheck(this,3)" value="<?php echo filter_input(INPUT_POST, "n4", FILTER_SANITIZE_NUMBER_INT); ?>"> /
                    <input name="prefix" type="number" min="0" max="32" step="1" oninput="maxLengthCheck(this,2)" value="<?php echo filter_input(INPUT_POST, "prefix", FILTER_SANITIZE_NUMBER_INT); ?>">
                </div>
            </div>
            <div>
                <label for="subnets">Počet&nbsp;podsítí</label>
                <div>
                    <input id="subnets" name="subnets" type="number" min="0" max="255" step="1" oninput="maxLengthCheck(this,3)" value="<?php echo filter_input(INPUT_POST, "subnets", FILTER_SANITIZE_NUMBER_INT); ?>">
                </div>
            </div>
            <div>
                <input type="submit" value="Vypočítej">
            </div>
        </form>

        <?php
        $prefix = filter_input(INPUT_POST, "prefix", FILTER_SANITIZE_NUMBER_INT);
        $subnets = filter_input(INPUT_POST, "subnets", FILTER_SANITIZE_NUMBER_INT);
        $ip = filter_input(INPUT_POST, "n1", FILTER_SANITIZE_NUMBER_INT) . "."
            . filter_input(INPUT_POST, "n2", FILTER_SANITIZE_NUMBER_INT) . "."
            . filter_input(INPUT_POST, "n3", FILTER_SANITIZE_NUMBER_INT) . "."
            . filter_input(INPUT_POST, "n4", FILTER_SANITIZE_NUMBER_INT);
        if ($prefix && $ip && $subnets) {
            $net = new Network('TEST', new AddressIPv4($ip), $prefix);
            if ($net->isValid()) {
                echo '<h2>Zadaný rozsah</h2>';
                $net->show();
                $maxSubnetCount = pow(2, 30 - $prefix);
                if ($subnets > $maxSubnetCount) {
                    Message::print("Chyba", "Tolik podsítí nelze v zadaném rozsahu vytvořit.");
                } else {
                    echo '<h2>Podsítě</h2>';
                    $subnetBits = strlen(decbin($subnets - 1));
                    for ($i = 0; $i < $subnets; $i++) {
                        $sub = new Network(
                            $net->getName() . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                            $net->getNetworkAddress()->getNextAddress($i * pow(2, 32 - ($prefix + $subnetBits))),
                            $prefix + $subnetBits,
                            $prefix
                        );
                        if ($sub->isValid()) {
                            $sub->show();
                        } else {
                            Message::print("Chyba", "Subneta není validní. Podivné.");
                        }
                    }
                }
                echo '<p>';
                foreach (['network', 'subnet', 'mixed', 'host'] as $val) {
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