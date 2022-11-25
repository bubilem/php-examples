<?php

/**
 * Class Loader
 */
class Loader
{
    /**
     * Obstarání načtení patřičného souboru třídy
     * 
     * 1. Nejprve se z názvu třídy určí cesta a název souboru
     * 2. Poté, když existuje, se načte, jinak se vyhodí vyjímka.
     *
     * @param string $className název třídy
     * @return void
     */
    public static function loadClass(string $className)
    {
        $filename = self::getFilename($className);
        if (file_exists($filename)) {
            require_once $filename;
        } else {
            throw new Exception("Class file $filename not found.");
        }
    }

    /**
     * Určí cestu a název souboru k patřičnému názvu třídy
     *
     * @param string $className název trídy
     * @return string
     */
    private static function getFilename(string $className): string
    {
        foreach ([
            'Controller' => 'app/controller',
            'Model' => 'app/model'
        ] as $classTypeName => $directory) {
            if (preg_match('~.*' . $classTypeName . '$~', $className)) {
                return "$directory/$className.php";
            }
        }
        return "app/util/$className.php";
    }
}
