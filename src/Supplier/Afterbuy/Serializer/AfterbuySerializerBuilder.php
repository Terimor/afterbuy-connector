<?php


namespace App\Supplier\Afterbuy\Serializer;


use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class AfterbuySerializerBuilder
{
    public function build(): SerializerInterface
    {
        return SerializerBuilder::create()
            ->setDebug(true)
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
            ->build();
    }
}