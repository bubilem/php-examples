<?php
abstract class BaseList
{

    protected $items;

    public function __construct()
    {
        $this->clear();
    }

    public function clear()
    {
        $this->items = [];
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function toJson(): string
    {
        return json_encode($this->items);
    }
}
