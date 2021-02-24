<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Image Upload</title>
</head>

<body>
    <main>
        <nav>
            <a href="index.php">[Show images]</a>
            <a href="upload.php"><b>[Upload image]</b></a>
            <a href="delete.php">[Delete images]</a>
        </nav>
        <h1>Upload</h1>
        <?php
        if (filter_input(INPUT_POST, 'action') == 'Upload') {
            $conf = json_decode(file_get_contents("conf.json"), true);
            if (
                !empty($_FILES['image-file']['name'])
                && isset($_FILES['image-file']['type'])
                && $_FILES['image-file']['type'] == $conf['src-type']
            ) {
                $srcImg = imagecreatefromjpeg($_FILES['image-file']['tmp_name']);
                $srcWidth = imagesx($srcImg);
                $srcHeight = imagesy($srcImg);
                foreach ($conf['dst-configurations'] as $fileConf) {
                    if ($srcWidth > $fileConf['max-width'] || $srcHeight > $fileConf['max-height']) {
                        $rw = $fileConf['max-width'] / $srcWidth;
                        $rh = $fileConf['max-height'] / $srcHeight;
                        $ratio = $rw < $rh ? $rw : $rh;
                        $dstWidth = intval($srcWidth * $ratio);
                        $dstHeight = intval($srcHeight * $ratio);
                    } else {
                        $dstWidth = $srcWidth;
                        $dstHeight = $srcHeight;
                    }
                    $dstImg = imagecreatetruecolor($dstWidth, $dstHeight);
                    imagecopyresized($dstImg, $srcImg, 0, 0, 0, 0, $dstWidth, $dstHeight, $srcWidth, $srcHeight);
                    $filename = $conf['dst-name'] . $fileConf['postfix'] . '.' . $conf['dst-ext'];
                    if (imagejpeg($dstImg, __DIR__ . '/' . $conf['dst-path'] . $filename, $fileConf['quality'])) {
                        echo "<p>Image <b>$filename</b> has been created.</p>";
                    } else {
                        echo "<p>Error! Image <b>$filename</b> has not been created.</p>";
                    }
                    imagedestroy($dstImg);
                }
                imagedestroy($srcImg);
            } else {
                echo '<p>The file was not sent or is not of the requested type.</p>';
            }
        }
        ?>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Upload form</legend>
                <label for="image-file">Image: </label>
                <input id="image-file" name="image-file" type="file" accept="image/jpeg" required>
                <input type="submit" name="action" value="Upload">
            </fieldset>
        </form>
    </main>
</body>

</html>