<main>
    <?php
    if (file_exists("content/pages/" . $p . ".php")) {
        require "content/pages/" . $p . ".php";
    }
    ?>
</main>