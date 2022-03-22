<?php

/**
 * 2D Point class
 */
class Point
{
    /**
     * Point position value
     *
     * @var Vector2D
     */
    private $position;

    public function __construct(Vector2D $position)
    {
        $this->setPosition($position);
    }

    /**
     * Get point position value
     *
     * @return  Vector2D
     */
    public function getPosition(): Vector2D
    {
        return $this->position;
    }

    /**
     * Set point position value
     *
     * @param  Vector2D  $position  Point position value 
     * @return  self
     */
    public function setPosition(Vector2D $position): self
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Distance between the points
     *
     * @param Point $other
     * @return float distance to the other point
     */
    public function getDistance(Point $other): float
    {
        $dx = abs($this->position->getX() - $other->getPosition()->getX());
        $dy = abs($this->position->getY() - $other->getPosition()->getY());
        return sqrt(pow($dx, 2), pow($dy, 2));
    }
}
