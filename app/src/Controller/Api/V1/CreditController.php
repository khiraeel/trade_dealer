<?php

declare(strict_types = 1);

namespace App\Controller\Api\V1;

use App\Exception\CarNotFoundException;
//use App\Service\CreditService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Dto\CreditCalculationDto;

/**
 * @Route("/credit")
 */
final class CreditController extends BaseController
{
    private CreditService $creditService;

    public function __construct(
        CreditService $creditService
    ) {
        $this->creditService = $creditService;
    }

    /**
     * @Route("/calculate", name="calculate", methods="GET")
     */
    public function calculate(Request $request): Response
    {
        $dto = new CreditCalculationDto(
            $request->get('price'),
            $request->get('initialPayment'),
            $request->get('loanTerm'),
        );

        $result = $this->creditService->calculate($dto);

//        $carsView = new CarsView($list);
//        $carsData = $carsView->getData();
//
        return $this->createResponseSuccess([]);
    }
}