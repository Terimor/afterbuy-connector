<?php


namespace App\Api\Builder;


use App\Api\Entity\Request\ApiRequestInterface;
use App\Api\Exception\WrongRequestClassApiException;
use JMS\Serializer\SerializerInterface;

class ApiRequestBuilder
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function build(string $data, string $type): ApiRequestInterface
    {
        $request = $this->serializer->deserialize($data, $type, 'json');

        $requestClass = get_class($request);
        if ($requestClass !== $type) {
            throw new WrongRequestClassApiException($requestClass, $type);
        }

        return $request;
    }
}