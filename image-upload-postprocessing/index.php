<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Images</title>
</head>

<body>
    <main>
        <nav>
            <a href="index.php"><b>[Show images]</b></a>
            <a href="upload.php">[Upload image]</a>
            <a href="delete.php">[Delete images]</a>
        </nav>
        <h1>Images</h1>
        <?php
        $conf = json_decode(file_get_contents("conf.json"), true);
        foreach ($conf['dst-configurations'] as $fileConf) {
            echo '<p>';
            $filename = $conf['dst-path'] . $conf['dst-name'] . $fileConf['postfix'] . '.' . $conf['dst-ext'];
            if (file_exists($filename)) {
                echo "$filename<br>";
                echo '<img src="' . $filename . '" alt="' . $filename . '">';
            } else {
                echo "File $filename not found.";
            }
            echo '</p>';
        }
        ?>
    </main>
</body>

</html>