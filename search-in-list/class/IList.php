<?php
interface IList
{
    public function add(int $value);

    public function exists(int $value): bool;

    public function count(): int;

    public function clear();

    public function toJson(): string;
}
