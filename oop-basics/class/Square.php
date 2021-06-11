<?php

/**
 * Čtverec
 * 
 * Je potomkem třídy Shape.
 * Zavazuje se plnit rozhraní Measurable.
 * Je určen dvěma sousedními body. Může být rotován.
 */
class Square extends Shape implements Measurable
{

    /**
     * První bod (A) čtverce
     *
     * @var Point
     */
    private $a;

    /**
     * Druhý bod (B) čtverce
     *
     * @var Point
     */
    private $b;

    public function __construct(Point $a = null, Point $b = null)
    {
        if ($a instanceof Point) {
            $this->a = $a;
        } else {
            $this->a = new Point(0, 0);
        }
        if ($b instanceof Point && $a->getDistance($b) > 0) {
            $this->b = $b;
        } else {
            $this->b = new Point($this->a->getX() + 1, $this->a->getY());
        }
    }

    public function setA(Point $a): void
    {
        $this->a = $a;
    }

    public function getA(): Point
    {
        return $this->a;
    }

    public function setB(Point $b): void
    {
        $this->b = $b;
    }

    public function getB(): Point
    {
        return $this->b;
    }

    /**
     * Obvod čtverce (4*a)
     *
     * Vypočte a vrátí obvod čtverce. Povinná metoda, abychom splnili rozhraní Measurable
     * @return float
     */
    public function o(): float
    {
        return round(4 * $this->a->getDistance($this->b), 3);
    }


    /**
     * Obsah čtverce (a*a)
     *
     * Vypočte a vrátí obsah kruhu. Povinná metoda, abychom splnili rozhraní Measurable
     * @return float
     */
    public function s(): float
    {
        return round(pow($this->a->getDistance($this->b), 2), 3);
    }

    /**
     * Reprezentace objektu jako řetězec
     *
     * Magická metoda, jejíž výsledek se použije, když je s objektem manipulováno jako s textem.
     * @return string
     */
    public function __toString()
    {
        return "square: A" . $this->a . ", B" . $this->b . ", o="
            . $this->o() . $this->unit . ", s="
            . $this->s() . $this->unit . "2)";
    }
}
