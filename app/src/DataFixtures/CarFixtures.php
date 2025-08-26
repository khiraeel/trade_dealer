<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\CarBrand;
use App\Entity\CarModel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brands = [];
        $models = [];
        $brands_count = 10;
        $model_count = 10;

        for ($i = 1; $i <= $brands_count; $i++) {
            $brand = new CarBrand("Brand $i");
            $manager->persist($brand);
            $brands[] = $brand;
        }

        for ($i = 1; $i <= $model_count; $i++) {
            $model = new CarModel("Model $i");
            $manager->persist($model);
            $models[] = $model;
        }

        for ($i = 1; $i <= 100; $i++) {
            $brand = $brands[array_rand($brands)];
            $model = $models[array_rand($models)];
            $photo = "https://picsum.photos/200/100?random=$i";
            $price = random_int(500_000, 5_000_000);

            $car = new Car(
                $brand,
                $model,
                $photo,
                $price
            );

            $manager->persist($car);
        }

        $manager->flush();
    }
}
