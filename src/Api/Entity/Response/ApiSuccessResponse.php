<?php


namespace App\Api\Entity\Response;


use Symfony\Component\HttpFoundation\Response;

class ApiSuccessResponse implements ApiResponseInterface
{
    public function getStatusCode(): int
    {
        return Response::HTTP_OK;
    }
}