<?php

/**
 * Random Controller
 */
class RandomController extends MainController
{
    /**
     * Hlavní spouštecí metoda run
     * 
     * 1. Vypíše pouze a jen náhodné číslo z intervalu <10,99>, tedy náhodné dvouciferné číslo
     *
     * @return void
     */
    public function run()
    {
        echo mt_rand(10, 99);
    }
}
