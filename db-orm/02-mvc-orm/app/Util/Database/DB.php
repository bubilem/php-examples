<?php

namespace SimpleOrmExample\Util\Database;

class DB implements IDB
{

    private $link;
    private $lastResult;

    public function __construct(
        string $dbHost = '',
        string $dbUser = '',
        string $dbPassword = '',
        string $dbDatabase = '',
        string $charset = 'UTF8'
    ) {
        $this->link = null;
        $this->lastResult = null;
        $this->connect($dbHost, $dbUser, $dbPassword, $dbDatabase, $charset);
    }

    public function connect(
        string $dbHost = '',
        string $dbUser = '',
        string $dbPassword = '',
        string $dbDatabase = '',
        string $charset = 'UTF8'
    ): bool {
        if (($this->link = @mysqli_connect(
            $dbHost ? $dbHost : DB_HOST,
            $dbUser ? $dbUser : DB_USER,
            $dbPassword ? $dbPassword : DB_PASS,
            $dbDatabase ? $dbDatabase : DB_DTBS
        )) !== false) {
            $this->query("SET CHARACTER SET $charset");
            return true;
        } else {
            $this->link = null;
            return false;
        }
    }

    public function isConnected(): bool
    {
        return $this->link !== null;
    }

    public function close(): bool
    {
        if ($this->link !== null) {
            return mysqli_close($this->link);
        }
        return false;
    }

    public function query(string $query)
    {
        if ($this->link == null) {
            return false;
        }
        $this->lastResult = mysqli_query($this->link, $query);
        return $this->lastResult;
    }

    public function fetch($result = null)
    {
        return mysqli_fetch_array($result != null ? $result : $this->lastResult, MYSQLI_ASSOC);
    }

    public function fetchAll($result = null)
    {
        $array = [];
        while ($record = $this->fetch($result != null ? $result : $this->lastResult)) {
            $array[] = $record;
        }
        return $array;
    }

    public function getLastError(): string
    {
        return $this->link !== null ? mysqli_error($this->link) : '';
    }

    public function getAffectedRows(): int
    {
        return $this->link !== null ? intval(mysqli_affected_rows($this->link)) : 0;
    }

    public function getNumRows($result): int
    {
        return intval(mysqli_num_rows($result));
    }
}
