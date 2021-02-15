<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8" />
    <title>Images</title>
</head>

<body>
    <?php
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (!$id) {
        echo '<code>Try input GET ?id=</code>';
        $id = 1;
    }
    ?>
    <p><a href="save-image-to-db.php?img=">Save image to DB</a></p>

    <code>&lt;img src="img/<?php echo $id; ?>.jpg" alt="cosmonaut on the moon" /&gt;</code>
    <p><img src="img/<?php echo $id; ?>.jpg" alt="cosmonaut on the moon" /></p>

    <code>&lt;img src="image-db.php?id=<?php echo $id; ?>" alt="cosmonaut on the moon" /&gt;</code>
    <p><img src="image-db.php?id=<?php echo $id; ?>" alt="cosmonaut on the moon" /></p>
</body>

</html>