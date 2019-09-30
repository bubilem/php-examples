<?php

/**
 * Simple database controller class
 */
class DB implements IDB
{
    /**
     * Connection to database
     *
     * @var mysqli|false
     */
    private $connection;

    /**
     * Error message after last query
     *
     * @var string
     */
    private $lastError;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->connection = null;
        $this->lastError = '';
    }

    /**
     * Database initialization
     *
     * @param string $dbHost
     * @param string $dbUser
     * @param string $dbPassword
     * @param string $dbDatabase
     * @param string $charset
     * @return boolean
     */
    public function init(string $dbHost, string $dbUser, string $dbPassword, string $dbDatabase, string $charset = 'UTF8'): bool
    {
        $this->connection = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbDatabase);
        if ($this->connection == false) {
            return false;
        }
        $this->query("SET CHARACTER SET $charset");
        return true;
    }

    /**
     * Close connection
     *
     * @return boolean
     */
    public function close(): bool
    {
        return (bool) mysqli_close($this->connection);
    }

    /**
     * Sends a query
     *
     * @param string $query
     * @return mysqli_result|bool
     */
    public function query(string $query)
    {
        $result = mysqli_query($this->connection, $query);
        if ($result === false) {
            $this->lastError = mysqli_error($this->connection);
        } else {
            $this->lastError = '';
        }
        return $result;
    }

    /**
     * Fetchs one record from result to simple associative array
     *
     * @param mysqli_result $result
     * @return array|null
     */
    public function fetch($result)
    {
        return mysqli_fetch_array($result);
    }

    /**
     * Fetchs all records from result to two-dimensional associative array
     *
     * @param mysqli_result $result
     * @return array|null
     */
    public function fetchAll($result)
    {
        $array = [];
        while ($record = $this->fetch($result)) {
            $array[] = $record;
        }
        return $array;
    }

    /**
     * Last error geter
     *
     * @return string
     */
    public function getLastError(): string
    {
        return $this->lastError;
    }
}
