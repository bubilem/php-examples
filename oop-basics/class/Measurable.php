<?php

/**
 * Měřitelné
 * 
 * Rozhraní pro tvary, které budou garantovat existenci zde uvedených metod
 */
interface Measurable
{

    /**
     * Obvod
     *
     * Vypočte a vrátí obvod tvaru.
     * @return float
     */
    public function o(): float;

    /**
     * Obsah
     *
     * Vypočte a vrátí obsah tvaru.
     * @return float
     */
    public function s(): float;
}
