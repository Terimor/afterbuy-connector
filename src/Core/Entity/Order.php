<?php

namespace App\Core\Entity;

use App\Core\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
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
     * @ORM\OneToMany(targetEntity=SoldItem::class, mappedBy="order", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private Collection $soldItems;

    public function __construct()
    {
        $this->soldItems = new ArrayCollection();
    }

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

    /**
     * @return Collection|SoldItem[]
     */
    public function getSoldItems(): Collection
    {
        return $this->soldItems;
    }

    public function addSoldItem(SoldItem $soldItem): void
    {
        if (!$this->soldItems->contains($soldItem)) {
            $this->soldItems[] = $soldItem;
            $soldItem->setOrder($this);
        }
    }
}
