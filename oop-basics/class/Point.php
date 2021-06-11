<?php
class Point
{
    /**
     * Pozice na ose X
     *
     * Instanční atribut, popisná vlastnost
     * @var float
     */
    private $x;

    /**
     * Posize na ose Y
     *
     * Instanční atribut, popisná vlastnost
     * @var float
     */
    private $y;

    /**
     * Konstruktor
     *
     * Spouští se při vytváření (new) instance z třídy
     * @param float $x
     * @param float $y
     */
    public function __construct(float $x = 0, float $y = 0)
    {
        $this->setPos($x, $y);
    }

    /**
     * Nastavení atributů x a y
     *
     * sdružený setter pro x i y
     * @param float $x
     * @param float $y
     * @return void
     */
    public function setPos(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Getter atributu X
     *
     * Vrací hodnotu instančního atributu x
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * Getter atributu Y
     *
     * Vrací hodnotu instančního atributu y
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * Spočtení vzdálenosti k bodu
     *
     * Spočte a vrátí vzdálenost od this k p
     * @param Point $p Bod, ke kterému počítáme vzdálenost 
     * @return float vzdálenost
     */
    public function getDistance(Point $p): float
    {
        return sqrt(pow($this->x - $p->getX(), 2) + pow($this->y - $p->getY(), 2));
    }

    /**
     * Reprezentace objektu bod jako řetězec
     *
     * Magická metoda, jejíž výsledek se použije, když je s objektem manipulováno jako s textem.
     * @return string
     */
    public function __toString()
    {
        return "[" . $this->x . ";" . $this->y . "]";
    }
}
