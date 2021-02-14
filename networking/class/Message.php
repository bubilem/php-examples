<?php
class Message
{
    public static function print($caption, $message)
    {
        echo "<div class=\"message\"><b>$caption</b><br>$message</div>";
    }
}
