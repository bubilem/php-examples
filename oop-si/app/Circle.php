<?php

/**
 * Circle class
 */
class Circle extends Shape implements ICountable
{
    /**
     * Center point of the circle
     *
     * @var Point
     */
    private $center;

    /**
     * Radius of the circle
     *
     * @var float
     */
    private $r;

    public function __construct(Point $center, float $r)
    {
        parent::__construct("circle");
        $this->center = $center;
        $this->r = $r;
    }

    /**
     * Area calculation
     *
     * @return float area
     */
    public function getArea(): float
    {
        return M_PI * pow($this->r, 2);
    }

    /**
     * Get center point of the circle
     *
     * @return  Point
     */
    public function getCenter(): Point
    {
        return $this->center;
    }

    /**
     * Set center point of the circle
     *
     * @param  Vector2D  $center  Center point of the circle
     * @return  self
     */
    public function setCenter(Vector2D $center): self
    {
        $this->center = $center;
        return $this;
    }

    /**
     * Get radius of the circle
     *
     * @return  float
     */
    public function getR(): float
    {
        return $this->r;
    }

    /**
     * Set radius of the circle
     *
     * @param  float  $r  Radius of the circle
     * @return  self
     */
    public function setR(float $r): self
    {
        $this->r = $r;
        return $this;
    }
}
