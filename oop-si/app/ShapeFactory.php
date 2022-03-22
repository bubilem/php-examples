<?php

/**
 * Static factory class
 */
class ShapeFactory
{

    public static function createUnitCircle(): Circle
    {
        return new Circle(new Point(new Vector2D(0, 0)), 1);
    }
}
