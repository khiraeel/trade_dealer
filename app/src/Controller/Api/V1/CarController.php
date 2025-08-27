<?php

declare(strict_types = 1);

namespace App\Controller\Api\V1;

use App\Exception\CarNotFoundException;
use App\Exception\CreditProgramNotFoundException;
use App\Service\CarService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\View\CarsView;
use App\View\CarView;

final class CarController extends BaseController
{
    private CarService $carService;

    public function __construct(
        CarService $carService
    ) {
        $this->carService = $carService;
    }

    /**
     * @Route("/cars", name="cars_list", methods="GET")
     */
    public function list(): JsonResponse
    {
        $list = $this->carService->getCars();

        $carsView = new CarsView($list);
        $carsData = $carsView->getData();

        return $this->createResponseSuccess($carsData);
    }

    /**
     * @param int $id
     * @Route("/cars/{id}", name="car_detail", methods="GET")
     */
    public function detail(int $id): JsonResponse
    {
        try {
            $car = $this->carService->getCarById($id);

            $carView = new CarView($car);
            $carData = $carView->getDetailData();

            return $this->createResponseSuccess($carData);
        }catch (CarNotFoundException|CreditProgramNotFoundException $ex){
            return $this->createResponseNotFound([
                'message' => $ex->getMessage(),
            ]);
        }
    }
}