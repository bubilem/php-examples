<?php

class DB
{
    private static $link = null;

    public static function connect()
    {
        if (!(self::$link = @mysqli_connect("localhost", "root", "", "database-name"))) {
            die("Unable to connect to DBMS.");
        }
        self::query('SET CHARACTER SET UTF8');
    }

    public static function close()
    {
        if (self::$link) {
            mysqli_close(self::$link);
        }
    }

    public static function query(string $query)
    {
        if (self::$link == null) {
            self::connect();
        }
        return mysqli_query(self::$link, $query);
    }

    public static function fetch($result)
    {
        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    public static function fetchAll($result)
    {
        $records = [];
        while ($row = DB::fetch($result)) {
            $records[] = $row;
        }
        return $records;
    }

    public static function fetchQueryToArray(string $query)
    {
        $result = self::query($query);
        if ($result instanceof mysqli_result) {
            return self::fetchAll($result);
        } else {
            return false;
        }
    }

    public static function getInsertId()
    {
        return mysqli_insert_id(self::$link);
    }
}
