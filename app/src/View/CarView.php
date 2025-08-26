<?php

namespace App\View;

use App\Entity\Car;

/**
 * @readonly
 */
class CarView
{
    private Car $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function getData(): array
    {
        return [
            'id' => $this->car->getId(),
            'brand' => [
                'id' => $this->car->getBrand()->getId(),
                'name' => $this->car->getBrand()->getName()
            ],
            'photo' => $this->car->getPhoto(),
            'price' => $this->car->getPrice(),
        ];
    }

    public function getDetailData(): array
    {
        return [
            'id' => $this->car->getId(),
            'brand' => [
                'id' => $this->car->getBrand()->getId(),
                'name' => $this->car->getBrand()->getName()
            ],
            'model' => [
                'id' => $this->car->getModel()->getId(),
                'name' => $this->car->getModel()->getName()
            ],
            'photo' => $this->car->getPhoto(),
            'price' => $this->car->getPrice(),
        ];
    }
}