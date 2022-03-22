<?php

/**
 * General 2D vector class
 */
class Vector2D
{
    /**
     * X value
     *
     * @var float
     */
    private $x;

    /**
     * Y value
     *
     * @var float
     */
    private $y;

    public function __construct(float $x, float $y)
    {
        $this->setX($x);
        $this->setY($y);
    }

    /**
     * Get x value
     *
     * @return  float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * Set x value
     *
     * @param  float  $x  X value
     * @return  self
     */
    public function setX(float $x): self
    {
        $this->x = $x;
        return $this;
    }

    /**
     * Get y value
     *
     * @return  float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * Set y value
     *
     * @param  float  $y  Y value
     * @return  self
     */
    public function setY(float $y): self
    {
        $this->y = $y;
        return $this;
    }
}
