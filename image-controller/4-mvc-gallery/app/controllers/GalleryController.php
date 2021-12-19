<?php

class GalleryController extends MainController
{

    public function run(): void
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Gallery</title>
            <link rel="stylesheet" href="www/css/style.css">
        </head>

        <body>
            <main>
                <h1>Gallery</h1>
                <div class="gallery">
                    <?php
                    foreach (json_decode(file_get_contents(DATA_DIR . 'db.json'), true) as $record) {
                        $file = new FileModel($record["id"]);
                        echo '<div>';
                        echo '<a href="' . $file->getUrl() . '">';
                        echo '<img src="' . $file->getUrl(true) . '" alt="' . $file->name . '">';
                        echo '</a>';
                        echo '<p>' . $file->name . '</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </main>
        </body>

        </html>

<?php
    }
}
