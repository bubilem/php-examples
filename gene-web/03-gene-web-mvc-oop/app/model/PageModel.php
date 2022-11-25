<?php

/**
 * Model pro stránku webu
 */
class PageModel extends MainModel
{
    /**
     * Konstruktor
     * 
     * @param string $key
     */
    public function __construct(string $key)
    {
        if (!$key) {
            $key = 'home';
        }
        if ($this->load("pages.json", $key) === false) {
            $this->load("pages.json", "404");
        }
    }

    /**
     * Getter na nadpis stránky
     *
     * @return string
     */
    public function getCaption(): string
    {
        return $this->getData("caption");
    }

    /**
     * Getter na popis stránky
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->getData("description");
    }
}
