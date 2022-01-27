<?php

namespace SimpleOrmExample\Util\Database;

interface IDB
{

    public function connect(
        string $dbHost = '',
        string $dbUser = '',
        string $dbPassword = '',
        string $dbDatabase = '',
        string $charset = 'UTF8'
    ): bool;

    public function isConnected(): bool;

    public function close(): bool;

    public function query(string $query);

    public function fetch($result);

    public function fetchAll($result);

    public function getLastError(): string;

    public function getAffectedRows(): int;

    public function getNumRows($result): int;
}
