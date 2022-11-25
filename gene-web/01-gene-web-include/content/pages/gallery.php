<?php
if (file_exists("img")) {
    $files = scandir("img");
    echo '<div class="gallery">' . "\n";
    foreach ($files as $file) {
        if ($file == "." || $file == "..") {
            continue;
        }
        echo '<img src="img/' . $file . '">' . "\n";
    }
    echo '</div>' . "\n";
}
