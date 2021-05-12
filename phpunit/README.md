# Základy testování v PHPUnit

Vytvoříme si základí příklad Unit testu v PHP.

## Základní postup

1. Vytvoříme si pracovní složku projektu a otevřeme si ji ve [VS Code](https://code.visualstudio.com/).
1. Nainstalujeme si [Composer](https://getcomposer.org/). Composer musí být nastaven v PATH (Uživatelské proměnné systému Windows).
1. Nainstalujeme si [PHPUnit 9.5](https://phpunit.readthedocs.io/en/9.5/index.html) příkazem v teminálu: `composer require --dev phpunit/phpunit ^9.5`. Vytvoří se složka _vendor_ se všemi potřebnými moduly, které PHPUnit potřebují a také základní konfigurační soubor [composer.json](composer.json).
1. Upravíme [composer.json](composer.json):
   - název projektu: `"name": "bubilem/basic-using-phpunit"`
   - popis projektu: `"description": "Basic using PHPUnit"`.
   - Autoload tříd necháme na composeru a standardu [PSR-4](https://www.php-fig.org/psr/psr-4/): `"autoload": { "psr-4": { "BasicPHPUnitTest\\": "app/" } }`. Namespace _BasicPHPUnitTest_ povede do složky [app](app).
1. Aktualizujeme si _vendor/autoload.php_ příkazem: `composer dump-autoload`.
1. Vytvoříme si soubor [index.php](index.php) a vložme do něj autoload: `require "vendor/autoload.php";` a další kód našeho programu.
1. Vytvoříme si třídy našeho projektu v [app](app), které budeme později testovat.
1. Vytvoříme si adresář [tests](tests), ve kterém si vytvoříme třídy pro testy.
1. Spustíme testy: `vendor/bin/phpunit --verbose tests`
