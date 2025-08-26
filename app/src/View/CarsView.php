<?php

namespace App\View;

use App\Entity\Car;

/**
 * @readonly
 */
class CarsView
{
    private array $cars;

    public function __construct(array $cars)
    {
        $this->cars = $cars;
    }

    public function getData(): array
    {
        $list = [];

        foreach ($this->cars as $car) {
            $list[] = (new CarView($car))->getData();
        }

        return $list;
    }
}