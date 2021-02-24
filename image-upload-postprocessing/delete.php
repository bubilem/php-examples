<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Images</title>
</head>

<body>
    <main>
        <nav>
            <a href="index.php">[Show images]</a>
            <a href="upload.php">[Upload image]</a>
            <a href="delete.php"><b>[Delete images]</b></a>
        </nav>
        <h1>Delete</h1>
        <?php
        if (filter_input(INPUT_POST, 'action') == 'Delete') {
            $conf = json_decode(file_get_contents("conf.json"), true);
            foreach ($conf['dst-configurations'] as $fileConf) {
                echo '<p>';
                $filename = $conf['dst-name'] . $fileConf['postfix'] . '.' . $conf['dst-ext'];
                if (
                    file_exists(__DIR__ . '/' . $conf['dst-path'] . $filename)
                    && unlink(__DIR__ . '/' . $conf['dst-path'] . $filename)
                ) {
                    echo "File <b>$filename</b> has been deleted.";
                } else {
                    echo "File <b>$filename</b> not found or delete error.";
                }
                echo '</p>';
            }
        }
        ?>
        <form action="delete.php" method="POST">
            <fieldset>
                <legend>Delete form</legend>
                <input type="submit" name="action" value="Delete">
            </fieldset>
        </form>
    </main>
</body>

</html>