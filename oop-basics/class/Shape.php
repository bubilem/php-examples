<?php

/**
 * Geometrický tvar
 * 
 * Základní rodičovská abstraktní třída pro tvary
 * Nemůžeme přímo z ní vytvářet instance (abstract). Můžeme z ní dědit atribut jednotky. Eviduje do count počet vytvořených tvarů.
 */
abstract class Shape
{
    /**
     * Zkratka jednotky
     * 
     * Atribut evidující zkratku jednotky délky. Každý objekt má nezávysle svou vlastní hodnotu.
     * @var string
     */
    protected $unit;


    /**
     * Seznam povolených jednotek
     *
     * Statický (třídní) atribut je přístupný z kontextu třídy.
     * Vytvořené objekty mohou sdílet hodnotu tohoto atributu. Nemají vlastní kopii.
     * @var array
     */
    protected static $allowedUnits = ["km", "m", "dm", "cm", "mm", "um", "nm"];

    /**
     * Počet vytvořených objektů
     * 
     * Statický atribut evidující počet vytvořených objektů (instancí).
     * Statická proměnná je inicializovaná hodnotou 0.
     * @var int
     */
    protected static $count = 0;

    /**
     * Konstruktor
     * 
     * "Magická" metoda, která se automaticky spouští při vytváření objektu z třídy.
     * @param string $unit nepovinný parametr pro jednotku
     */
    public function __construct(string $unit = 'm')
    {
        $this->unit = $unit; //uložení hodnoty parametru funkce do atributu
        self::$count++; //inkrementace statického atributu
    }

    /**
     * Destruktor
     * 
     * "Magická" metoda, která se volá, neexistuje-li na objekt reference. Objekt se ruší.
     */
    public function __destruct()
    {
        self::$count--; //dekrementace statického atributu
    }

    /**
     * Klonování
     * 
     * "Magická" metoda, která se volá, když se objekt klonuje z jiného.
     */
    public function __clone()
    {
        self::$count++; //inkrementace statického atributu
    }

    /**
     * Unit getter 
     *
     * Veřejná metoda, vracící hodnotou atributu unit.
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * Unit setter
     *
     * Veřejná metoda, nastavující hodnotou parametru unit do atributu unit.
     * Nastavuje se jen hodnota z povolených hodnot. Neřeší se velikost písmen.
     * @param string $unit
     * @return void
     */
    public function setUnit(string $unit): void
    {
        if (in_array(strtolower($unit), self::$allowedUnits)) {
            $this->unit = strtolower($unit);
        }
    }

    /**
     * Count getter
     * 
     * Statická metoda, která vrací hodnotu statického atributu count.
     * @return int
     */
    public static function getCount(): int
    {
        return self::$count;
    }
}
