<?php

/**
 * Model pro menu na stránce
 */
class MenuModel extends MainModel
{
    /**
     * Konstruktor
     * 
     * Zavolá rodičovský konstruktor
     */
    public function __construct()
    {
        parent::__construct("menu.json");
    }

    /**
     * Get all menu items stored in the data attribute
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->getData();
    }
}
