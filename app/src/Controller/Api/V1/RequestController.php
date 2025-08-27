<?php

declare(strict_types = 1);

namespace App\Controller\Api\V1;

use App\Dto\LoanCreationDto;
use App\Exception\CarNotFoundException;
use App\Exception\CreditProgramNotFoundException;
use App\Exception\InvalidArgumentException;
use App\Service\LoanService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class RequestController extends BaseController
{
    private ValidatorInterface $validator;
    private SerializerInterface $serializer;
    private LoanService  $loanService;

    public function __construct(
        ValidatorInterface $validator,
        SerializerInterface $serializer,
        LoanService $loanService
    ) {
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->loanService = $loanService;
    }

    /**
     * @Route("/request", name="request", methods="POST")
     */
    public function save(Request $request): Response
    {
        $requestBody = $request->getContent();
        $dto = $this->serializer->deserialize($requestBody, LoanCreationDto::class, 'json');

        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            return $this->createResponseBadRequest($errors);
        }

        try {
            $this->loanService->saveLoan($dto);

            return $this->createResponseSuccess([
                'success' => true
            ]);

        }catch (CarNotFoundException|CreditProgramNotFoundException|InvalidArgumentException $ex) {
            return $this->createResponseNotFound([
                'success' => false,
                'message' => $ex->getMessage(),
            ]);
        }catch (\Throwable $ex) {
            return $this->createResponseBadRequest([
                'success' => false,
                'message' => $ex->getMessage(),
            ]);
        }
    }
}