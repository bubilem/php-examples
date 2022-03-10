<?php

class DB
{

    public static $conn;

    public static function connect()
    {
        self::$conn = mysqli_connect(
            "localhost",
            "root",
            "",
            "products"
        );
        if (self::$conn === false) {
            die("Unable connect to dbms.");
        }
    }

    public static function query($sql)
    {
        $result = mysqli_query(self::$conn, $sql);
        if ($result === false) {
            die(mysqli_error(self::$conn));
        }
        return $result;
    }

    public static function fetch($result)
    {
        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
}
