<?php

namespace App\Core\Entity;

use App\Core\Repository\AfterbuyAccountRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AfterbuyAccountRepository::class)
 */
class AfterbuyAccount
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
    private string $userId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $userPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $partnerId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $partnerPassword;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="afterbuyAccount")
     */
    private Collection $orders;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserPassword(): ?string
    {
        return $this->userPassword;
    }

    public function setUserPassword(string $userPassword): void
    {
        $this->userPassword = $userPassword;
    }

    public function getPartnerId(): ?string
    {
        return $this->partnerId;
    }

    public function setPartnerId(string $partnerId): void
    {
        $this->partnerId = $partnerId;
    }

    public function getPartnerPassword(): ?string
    {
        return $this->partnerPassword;
    }

    public function setPartnerPassword(string $partnerPassword): void
    {
        $this->partnerPassword = $partnerPassword;
    }
}
