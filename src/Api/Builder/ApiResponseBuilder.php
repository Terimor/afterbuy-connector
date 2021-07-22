<?php


namespace App\Api\Builder;


use App\Api\Entity\Response\ApiResponseInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponseBuilder
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function build(ApiResponseInterface $response): JsonResponse
    {
        $serializedResponse = $this->serializer->serialize($response, 'json');

        return new JsonResponse($serializedResponse, JsonResponse::HTTP_OK, [], true);
    }
}