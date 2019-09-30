<?php

/**
 * Simple database interface
 */
interface IDB
{
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
    public function init(string $dbHost, string $dbUser, string $dbPassword, string $dbDatabase, string $charset): bool;

    /**
     * Close connection
     *
     * @return boolean
     */
    public function close(): bool;

    /**
     * Sends a query
     *
     * @param string $query
     * @return mysqli_result|bool
     */
    public function query(string $query);

    /**
     * Fetchs one record from result to simple associative array
     *
     * @param mysqli_result $result
     * @return array|null
     */
    public function fetch($result);

    /**
     * Fetchs all records from result to two-dimensional associative array
     *
     * @param mysqli_result $result
     * @return array|null
     */
    public function fetchAll($result);
}
