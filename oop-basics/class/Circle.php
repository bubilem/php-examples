<?php

/**
 * Kruh
 * 
 * Je potomkem třídy Shape.
 * Zavazuje se plnit rozhraní Measurable.
 */
class Circle extends Shape implements Measurable
{

    /**
     * Poloměr kruhu
     *
     * Privátní instanční atribut. Každý objekt má svou vlastní hodnotu
     * @var float
     */
    private $r;

    /**
     * Bod středu kružnice
     *
     * @var Point
     */
    private $center;

    /**
     * Konstruktor
     * "Magická" metoda, která se automaticky spouští při vytváření objektu z třídy Circle.
     * @param float $r nepovinný parametr pro poloměr
     */
    public function __construct(float $r = 1, Point $center = null)
    {
        parent::__construct(); //zavolání rodičovského konstruktoru
        $this->r = $r; //uložení hodnoty parametru r do atributu r
        if ($center instanceof Point) {
            $this->center = $center;
        } else {
            $this->center = new Point(0, 0);
        }
    }

    /**
     * Setter pro instanční atribut poloměr
     *
     * Veřejná metoda, nastavující hodnotou parametru r do atributu r.
     * @param float $r poloměr
     * @return void funkce (metoda) nic nevrací
     */
    public function setR(float $r): void
    {
        $this->r = $r;
    }

    /**
     * Getter instančního atributu poloměr
     *
     * Veřejná metoda, nastavující hodnotou parametru atributu r.
     * @return float poloměr
     */
    public function getR(): float
    {
        return $this->r;
    }

    /**
     * Setter instančního atributu bodu středu křužnice
     *
     * Veřejná metoda, nastavující hodnotu atributu center
     * @param Point $center
     * @return void
     */
    public function setCenter(Point $center): void
    {
        $this->center = $center;
    }

    /**
     * Getter středu kružnice
     *
     * Veřejná metoda vracející bod středu kružnice
     * @return Point
     */
    public function getCenter(): Point
    {
        return $this->center;
    }

    /**
     * Obvod (2*PI*r)
     *
     * Vypočte a vrátí obvod kruhu. Povinná metoda, abychom splnili rozhraní Measurable
     * @return float
     */
    public function o(): float
    {
        return round(2 * M_PI * $this->r, 3);
    }


    /**
     * Obsah (PI*r*r)
     *
     * Vypočte a vrátí obsah kruhu. Povinná metoda, abychom splnili rozhraní Measurable
     * @return float
     */
    public function s(): float
    {
        return round(M_PI * pow($this->r, 2), 3);
    }

    /**
     * Reprezentace objektu jako řetězec
     *
     * Magická metoda, jejíž výsledek se použije, když je s objektem manipulováno jako s textem.
     * @return string
     */
    public function __toString()
    {
        return "circle: S=" . $this->center . ", r=$this->r$this->unit, o="
            . $this->o() . $this->unit . ", s="
            . $this->s() . $this->unit . "2";
    }
}
