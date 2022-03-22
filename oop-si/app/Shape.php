<?php

/**
 * General shape class
 */
abstract class Shape
{
    /**
     * Count of objects
     *
     * @var int
     */
    private static $count = 0;

    /**
     * Name of the shape
     *
     * @var string
     */
    protected $name;

    /**
     * Shape contructor
     *
     * @param string $name name of the shape
     */
    public function __construct(string $name = "")
    {
        $this->name = $name;
        self::$count++;
    }

    public static function getCount(): int
    {
        return self::$count;
    }

    /**
     * Get name of the shape
     *
     * @return  string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * Set name of the shape
     *
     * @param  string  $name  Name of the shape
     * @return void
     */
    protected function setName(string $name): void
    {
        $this->name = $name;
    }
}
