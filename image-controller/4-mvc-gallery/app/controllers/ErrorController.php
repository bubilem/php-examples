<?php

class ErrorController extends MainController
{

    public function run(): void
    {
        header("HTTP/1.0 404 Not Found");
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>404 | Gallery</title>
            <link rel="stylesheet" href="www/css/style.css">
        </head>

        <body>
            <main>
                <h1>404 - Not Found</h1>
            </main>
        </body>

        </html>

<?php
    }
}
