<?php

declare(strict_types=1);

use BasicPHPUnitTest\geometry\Point;

final class PointTest extends PHPUnit\Framework\TestCase
{

    public function testStringRepresentation(): void
    {
        $point = new Point(0, 0);
        foreach ([
            [0, 0],
            [1, 42],
            [-1, 1],
        ] as $pos) {
            $this->assertSame(
                strval($point->setX($pos[0])->setY($pos[1])),
                "[" . $pos[0] . "," . $pos[1] . "]"
            );
        }
    }


    public function testSettersAndGetters(): void
    {
        $point = new Point(1, 2);
        $this->assertSame($point->getX(), 1);
        $this->assertSame($point->getY(), 2);
        $point->setX(3)->setY(4);
        $this->assertSame($point->getX(), 3);
        $this->assertSame($point->getY(), 4);
    }

    public function testDistanceFromCenter(): void
    {
        $center = new Point(0, 0);
        $point = new Point(0, 0);
        foreach ([
            [0, 0],
            [1, 1],
            [-1, 1],
            [-1, -1],
            [1, -1]
        ] as $pos) {
            $this->assertSame(
                $point->setX($pos[0])->setY($pos[1])->getDistance($center),
                sqrt(pow($pos[0], 2) + pow($pos[1], 2))
            );
        }
    }
}
