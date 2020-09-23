<?php
require_once "class/AddressIPv4.php";
require_once "class/Network.php";
require_once "class/Message.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Adresování s maskou podsítě proměnné délky</title>
    <meta charset="UTF-8" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script src="script.js"></script>
</head>

<body>
    <main>
        <nav><a href="index.php">Zpět</a></nav>

        <h1>Adresování s maskou podsítě proměnné délky - VLSM</h1>
        <form action="vlsm.php" method="POST">
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
                <label for="subnets">Max. počet hostů v&nbsp;podsítích</label>
                <div>
                    <input id="subnets" name="subnets" type="text" value="<?php echo filter_input(INPUT_POST, "subnets", FILTER_SANITIZE_STRING); ?>">
                </div>
            </div>
            <p>Zadávejte velikost požadovaných podsítí oddělené čárkou. Např: 20,5,10</p>
            <div>
                <input type="submit" value="Vypočítej">
            </div>
        </form>

        <?php
        $prefix = filter_input(INPUT_POST, "prefix", FILTER_SANITIZE_NUMBER_INT);
        $subnetsSize = filter_input(INPUT_POST, "subnets", FILTER_SANITIZE_STRING);
        $ip = filter_input(INPUT_POST, "n1", FILTER_SANITIZE_NUMBER_INT) . "."
            . filter_input(INPUT_POST, "n2", FILTER_SANITIZE_NUMBER_INT) . "."
            . filter_input(INPUT_POST, "n3", FILTER_SANITIZE_NUMBER_INT) . "."
            . filter_input(INPUT_POST, "n4", FILTER_SANITIZE_NUMBER_INT);
        if ($prefix && $ip && $subnetsSize) {
            $subnetsSize =  array_map(function ($n) {
                $size = intval($n);
                for ($i = 1; $i < pow(2, 32); $i *= 2) {
                    if ($i >= $size + 2) {
                        return $i;
                    }
                }
            }, explode(',', $subnetsSize));
            arsort($subnetsSize);
            //var_dump($subnetsSize);
            $net = new Network('TEST', new AddressIPv4($ip), $prefix);
            if ($net->isValid()) {
                echo '<h2>Zadaný rozsah</h2>';
                $net->show();
                $maxSize = pow(2, 32 - $prefix);
                $totalSize = 0;
                foreach ($subnetsSize as $val) {
                    $totalSize += $val;
                }
                if ($totalSize > $maxSize) {
                    Message::print("Chyba", "Takové podsítě nelze v zadaném rozsahu vytvořit.");
                } else {
                    echo '<h2>Podsítě</h2>';
                    $shift = 0;
                    foreach ($subnetsSize as $key => $subnetSize) {
                        $sub = new Network(
                            $net->getName() . str_pad($key + 1, 3, '0', STR_PAD_LEFT),
                            $net->getNetworkAddress()->getNextAddress($shift),
                            $prefix + (32 - $prefix - strlen(decbin($subnetSize - 1))),
                            $prefix
                        );
                        $shift += $subnetSize;
                        if ($sub->isValid()) {
                            $sub->show();
                        } else {
                            Message::print("Chyba", "Subneta není validní. Tak to nevyšlo.");
                        }
                    }
                }
                echo '<p>';
                foreach (['network', 'subnet', 'mixed', 'host'] as $val) {
                    echo '<span class="' . $val . '">' . $val . '</span> ';
                }
                echo '</p>';
            } else {
                Message::print("Chyba", "Špatně zadaná adresa sítě.");
            }
        }

        ?>
    </main>
</body>

</html>