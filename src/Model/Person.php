<?php
namespace App\Models;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Person extends AbstractController
{
    public $firstname;
    public $lastname;

    function __construct($firstname, $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public static function CreateTestList()
    {
        return [
            new Person('Вася','Пупкин'),
            new Person('Иван','Иванов'),
            new Person('Петр','Сидоров')
        ];
    }
}