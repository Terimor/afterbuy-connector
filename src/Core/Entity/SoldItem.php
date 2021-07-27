<?php

namespace App\Core\Entity;

use App\Core\Repository\SoldItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SoldItemRepository::class)
 */
class SoldItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="integer")
     */
    private int $externalId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="integer")
     */
    private int $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="soldItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private Order $order;

    /**
     * @ORM\Column(type="float")
     */
    private float $price;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="soldItems")
     */
    private ?Category $category = null;

    /**
     * @ORM\OneToOne(targetEntity=Volume::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn()
     */
    private ?Volume $volume = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $productCode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExternalId(): ?int
    {
        return $this->externalId;
    }

    public function setExternalId(int $externalId): void
    {
        $this->externalId = $externalId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): void
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }

    public function getVolume(): ?Volume
    {
        return $this->volume;
    }

    public function setVolume(?Volume $volume): void
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
