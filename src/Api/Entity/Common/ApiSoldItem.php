<?php


namespace App\Api\Entity\Common;


use JMS\Serializer\Annotation as Serializer;

class ApiSoldItem
{
    /** @Serializer\Type("int") */
    private ?int $id = null;

    /** @Serializer\Type("string") */
    private string $title;

    /** @Serializer\Type("int") */
    private int $quantity;

    /** @Serializer\Type("int") */
    private int $orderId;

    /** @Serializer\Type("float") */
    private float $price;

    /** @Serializer\Type("App\Api\Entity\Common\ApiCategory") */
    private ?ApiCategory $category = null;

    /** @Serializer\Type("App\Api\Entity\Common\ApiVolume") */
    private ?ApiVolume $volume = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getCategory(): ?ApiCategory
    {
        return $this->category;
    }

    public function setCategory(?ApiCategory $category): void
    {
        $this->category = $category;
    }

    public function getVolume(): ?ApiVolume
    {
        return $this->volume;
    }

    public function setVolume(?ApiVolume $volume): void
    {
        $this->volume = $volume;
    }
}