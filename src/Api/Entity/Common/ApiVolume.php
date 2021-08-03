<?php


namespace App\Api\Entity\Common;


use JMS\Serializer\Annotation as Serializer;

class ApiVolume
{
    /** @Serializer\Type("string") */
    private string $unit;

    /** @Serializer\Type("int") */
    private int $amount;

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }
}