<?php

namespace App\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends AbstractController
{
    /**
     * @param array|object $data
     */
    public function createResponseSuccess($data): JsonResponse
    {
        return $this->json($data);
    }

    /**
     * @param array|object $data
     */
    public function createResponseNotFound($data): JsonResponse
    {
        return $this->json($data, Response::HTTP_NOT_FOUND);
    }

    /**
     * @param array|object $data
     */
    public function createResponseInternalServerError($data): JsonResponse
    {
        return $this->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param array|object $data
     */
    public function createResponseBadRequest($data): JsonResponse
    {
        return $this->json($data, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param array|object $data
     */
    public function createResponseHttpConflict($data): JsonResponse
    {
        return $this->json($data, Response::HTTP_CONFLICT);
    }
}