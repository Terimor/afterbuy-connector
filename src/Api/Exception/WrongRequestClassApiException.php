<?php


namespace App\Api\Exception;


class WrongRequestClassApiException extends AbstractApiException
{
    private const ERROR_MESSAGE = 'Wrong request class: %s. Expected: %s.';

    public function __construct(string $requestClass, string $expectedClass)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $requestClass, $expectedClass));
    }
}