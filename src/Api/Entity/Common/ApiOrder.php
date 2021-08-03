<?php


namespace App\Api\Entity\Common;


use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class ApiOrder
{
    /** @Serializer\Type("DateTimeImmutable") */
    private DateTimeImmutable $dateTime;

    /** @Serializer\Type("string") */
    private string $afterbuyAccountName;

    public function getDateTime(): DateTimeImmutable
    {
        return $this->dateTime;
    }

    public function setDateTime(DateTimeImmutable $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    public function getAfterbuyAccountName(): string
    {
        return $this->afterbuyAccountName;
    }

    public function setAfterbuyAccountName(string $afterbuyAccountName): void
    {
        $this->afterbuyAccountName = $afterbuyAccountName;
    }
}