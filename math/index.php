<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <title>Factorials & Primorials</title>
    <style>
        * {
            font-family: monospace;
        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            text-align: center;
            padding: 0.25em 0.5em;
            border: 1px #ccc solid;
        }

        td {
            text-align: right;
        }
    </style>

</head>

<body>
    <h1>Factorials & Primorials</h1>
    <table>
        <tr>
            <th>n</th>
            <th>fact(n)</th>
            <th>primByLimit(n)</th>
            <th>primByCount(n)</th>
        </tr>
        <?php
        require "Math.php";
        const MAX = 15;
        for ($n = 1; $n <= MAX; $n++) {
            echo '<tr>';
            echo "<td>$n</td>";
            echo "<td>" . Math::int2Str(Math::fact($n)) . "</td>";
            echo "<td>" . Math::int2Str(Math::primByLimit($n)) . "</td>";
            echo "<td>" . Math::int2Str(Math::primByCount($n)) . "</td>";
            echo '</tr>';
        }
        ?>
    </table>
</body>

</html>