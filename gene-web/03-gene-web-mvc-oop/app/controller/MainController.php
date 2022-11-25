<?php

/**
 * Hlavní controller
 * Nelze z něj vytvářet instance
 */
abstract class MainController
{
    /**
     * URL parametry jako pole
     *
     * @var array
     */
    protected $params;

    /**
     * Konfigurace - instance z třídy Config
     *
     * @var Config
     */
    protected $config;

    /**
     * Konstruktor
     *
     * @param Config $config konfigurace
     * @param array $params url parametry
     */
    public function __construct(Config $config, array $params = [])
    {
        $this->params = $params;
        $this->config = $config;
    }

    /**
     * Getter na URL parametr
     *
     * @param int $key
     * @return string parametr
     */
    public function getParam(int $key): string
    {
        return $this->params[$key] ?? "";
    }

    /**
     * Abstraktní metoda run
     * Každý potomek ji musí mít deklarovanou
     *
     * @return void
     */
    abstract public function run();
}
