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

    /** @Serializer\Type("App\Api\Entity\Common\ApiOrder") */
    private ApiOrder $order;

    /** @Serializer\Type("float") */
    private float $price;

    /** @Serializer\Type("App\Api\Entity\Common\ApiCategory") */
    private ?ApiCategory $category = null;

    /** @Serializer\Type("App\Api\Entity\Common\ApiVolume") */
    private ?ApiVolume $volume = null;

    /** @Serializer\Type("string") */
    private ?string $productCode = null;

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

    public function getOrder(): ApiOrder
    {
        return $this->order;
    }

    public function setOrder(ApiOrder $order): void
    {
        $this->order = $order;
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

    public function getProductCode(): ?string
    {
        return $this->productCode;
    }

    public function setProductCode(?string $productCode): void
    {
        $this->productCode = $productCode;
    }
}