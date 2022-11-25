<?php

/**
 * Základní trída pro Modely 
 * Nelze z ní vytvářet instance
 */
abstract class MainModel
{
    /**
     * Data
     * Každý model má data. Potomci (child) si tato zdědí z rodiče (parent).
     *
     * @var array
     */
    private $data = [];

    /**
     * Konstruktor si načte json a zněj data
     *
     * @param string $jsonFile databáze v podobě json
     * @param string|null $key nepovinný klíč k objektu v jsonu
     */
    public function __construct(string $jsonFile, string $key = null)
    {
        $this->load($jsonFile, $key);
    }

    /**
     * Načtení objektu dle klíče z jsonu a převedení do pole
     * 
     * Načte z JSON jen jednu položku dle jejího KEY nbo celý JSON, když není KEY zadán
     *
     * @param string $jsonFile datový soubor
     * @param string|null $key nepovinný klíč
     * @return boolean load success
     */
    public function load(string $jsonFile, string $key = null): bool
    {
        $this->data = [];
        $json = json_decode(file_get_contents("data/$jsonFile"), true);
        if (!$json) {
            return false;
        }
        if (empty($key)) {
            $this->data = $json;
        } else if (isset($json[$key])) {
            $this->data = $json[$key];
        }
        return !empty($this->data);
    }

    /**
     * Získání hodnoty z dat dle klíče
     *
     * @param string $key klíč
     * @return string|array|null hodnota
     */
    protected function getData(string $key = null): string|array|null
    {
        return $key !== null ? ($this->data[$key] ?? null) : $this->data;
    }
}
