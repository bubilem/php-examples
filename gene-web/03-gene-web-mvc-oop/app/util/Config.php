<?php

/**
 * Konfigurace
 */
class Config
{
    /**
     * Data konfigurace
     *
     * @var array
     */
    private $data;

    /**
     * Konstruktor
     * Načte se konfigurační soubor a uloží se do atributu dat
     *
     * @param string $filename
     */
    public function __construct(string $filename = "config.json")
    {
        $this->data = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];
    }

    /**
     * Získání konfigurační položky dle klíče 
     *
     * @param string $key klíč položky
     * @param string $default výchozí hodnota
     * @return string hodnota položky konfigurace
     */
    public function get(string $key, $default = ""): string
    {
        return empty($this->data[$key]) ? $default : $this->data[$key];
    }
}
