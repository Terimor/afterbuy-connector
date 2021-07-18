<?php

namespace App\Core\Entity;

use App\Core\Enum\UnitEnum;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Volume
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $unit;

    private UnitEnum $unitCode;

    /**
     * @ORM\Column(type="float")
     */
    private float $amount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnitCode(): UnitEnum
    {
        return $this->unitCode;
    }

    public function setUnitCode(UnitEnum $unitCode): void
    {
        $this->unitCode = $unitCode;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @ORM\PostLoad()
     */
    public function doOnPostLoad(): void
    {
        $this->unitCode = UnitEnum::get($this->unit);
    }

    /**
     * @ORM\PreFlush()
     */
    public function doOnPreFlush(): void
    {
        $this->unit = $this->unitCode->getValue();
    }
}
