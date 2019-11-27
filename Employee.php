<?php
/**
 * Created by PhpStorm.
 * User: McCalister
 * Date: 20.11.2019
 * Time: 13:32
 */

abstract class User
{
    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}

class Student extends User
{
    public $age = 12;



}

$test = new Student();
echo $test->age;





