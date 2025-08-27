<?php

declare(strict_types = 1);

namespace App\Controller\Api\V1;

use App\Exception\CreditProgramNotFoundException;
use App\Service\CreditService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Dto\CreditCalculationDto;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/credit")
 */
final class CreditController extends BaseController
{
    private CreditService $creditService;
    private ValidatorInterface $validator;

    public function __construct(
        CreditService $creditService,
        ValidatorInterface $validator
    ) {
        $this->creditService = $creditService;
        $this->validator = $validator;
    }

    /**
     * @Route("/calculate", name="calculate", methods="GET")
     */
    public function calculate(Request $request): Response
    {
        $dto = new CreditCalculationDto(
            (int)$request->query->get('price'),
            $request->query->get('initialPayment'),
            (int)$request->query->get('loanTerm')
        );

        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            return $this->createResponseBadRequest($errors);
        }

        try {
            $result = $this->creditService->calculate($dto);

            return $this->createResponseSuccess($result);
        } catch (CreditProgramNotFoundException $e) {
            return $this->createResponseBadRequest([
                'error' => $e->getMessage()
            ]);
        }
    }
}