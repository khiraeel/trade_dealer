<?php

namespace App\Service;

use App\Entity\Car;
use App\Exception\CarNotFoundException;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;

class CarService
{
    private $carRepository;
    private $entityManager;

    public function __construct(
        CarRepository $carRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->carRepository = $carRepository;
        $this->entityManager = $entityManager;
    }

    public function getCars(): array
    {
        return $this->carRepository->findAll();
    }

    public function getCarById(int $id): ?Car
    {
        $car = $this->carRepository->find($id);
        if(!$car instanceof Car) {
            throw new CarNotFoundException('Car by id: ' . $id . ' not found');
        }

        return $car;
    }
}