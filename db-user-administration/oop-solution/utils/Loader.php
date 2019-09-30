<?php

/**
 * Application class loader
 */
class Loader
{

    /**
     * Associative array of class types and theirs directories
     *
     * @var array
     */
    public static $classTypes = [
        'Controller' => 'controllers',
        'Model' => 'models',
        'View' => 'views'
    ];

    /**
     * Default class directory
     */
    const DEFAULT_CLASS_DIR = 'utils';

    /**
     * Main load method - makes require class file
     *
     * @param string $className
     * @return void
     */
    public static function loadClass(string $className)
    {
        $path = self::detectClassTypeDir($className) . '/' . $className . '.php';
        if (file_exists($path)) {
            require_once $path;
        } else {
            exit("Class not found!");
        }
    }

    /**
     * Specifies by class name its directory
     *
     * @param string $className
     * @return string
     */
    private static function detectClassTypeDir(string $className): string
    {
        foreach (self::$classTypes as $classTypeName => $classTypeDirectory) {
            if (preg_match('~.*' . $classTypeName . '$~', $className)) {
                return $classTypeDirectory;
            }
        }
        return self::DEFAULT_CLASS_DIR;
    }
}
