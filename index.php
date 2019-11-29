<?php
require_once "Tag.php";

class Circle
{
    const PI = 3.14; // запишем число ПИ в константу
    private $radius; // радиус круга

    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    // Найдем площадь:
    public function getSquare()
    {
        // Пи умножить на квадрат радиуса
        return self::PI * pow($this->radius, 2);
    }

    // Найдем длину окружности:
    public function getCircuit()
    {
        // 2 Пи умножить на радиус
    }
}



$cir = new Circle(5);
echo $cir->getSquare();
echo get_class($cir);






