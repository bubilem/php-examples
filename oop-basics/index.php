<?php
require "autoload.php";

echo Shape::getCount() . "\n"; //Vypíše počet vytvořených tvarů (voláme z třídy Shape).
$c1 = new Circle(); //Do c1 se vytvoří nový objekt z třídy Circle.
echo $c1 . "\n"; //Pracujeme s objektem c1 jako s textem, vypisujeme jej. Volá se __toString().
$c1->setR(1); //Nastavíme poloměr kruhu c1 na hodnotu 1.
$c1->setUnit("cm"); //Nastavíme jendotky kruhu c1 na hodnotu "cm".
echo $c1 . "\n"; //Opět vypíšeme textovou reprezentaci kruhu c1.
echo Shape::getCount() . "\n"; //Vypíše počet vytvořených tvarů.
$c2 = $c1; //Objekt se nekopíruje, neklonuje, neduplikuje. Nyní jen c1 i c2 ukazují na stejný objekt
echo Shape::getCount() . "\n"; //Vypíše počet vytvořených tvarů.
$c2 = clone $c1; //Do c2 jsme vytvořili klon c1. Nyní již duplikujeme.
echo $c2 . "\n"; //Vypisujeme objekt c2.
echo Shape::getCount() . "\n"; //Vypíše počet vytvořených tvarů.
$c3 = new Circle(2, new Point(3, 2)); //Do c3 se vytvoří nový objekt z třídy Circle a nastaví se rovnou poloměr a střed.
echo Circle::getCount() . "\n"; //Vypíše počet vytvořených tvarů (voláme z třídy Circle).
$c3->setUnit("cm"); //Nastavíme jendotky kruhu c3 na hodnotu "cm".
echo $c3 . "\n"; //Vypisujeme objekt c3.
echo $c1->getCenter()->getDistance($c3->getCenter()) . " " . $c1->getUnit() . "\n";
$c3 = null; //Zrušíme obsah proměné, nesoucí ukazatel na objekt. Nedosažitelný objekt se ruší.
echo $c1->getCount() . "\n"; //Vypíše počet vytvořených tvarů (voláme z objektu c1).