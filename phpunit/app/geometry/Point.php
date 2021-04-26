<?php

namespace BasicPHPUnitTest\geometry;

class Point
{
    private $x;

    private $y;

    public function __construct(int $x, int $y)
    {
        $this->setX($x)->setY($y);
    }

    public function setX($value): Point
    {
        $this->x = intval($value);
        return $this;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function setY($value): Point
    {
        $this->y = intval($value);
        return $this;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getDistance(Point $p): float
    {
        return sqrt(pow($this->x - $p->getX(), 2) + pow($this->y - $p->getY(), 2));
    }

    public function __toString()
    {
        return "[$this->x,$this->y]";
    }
}
