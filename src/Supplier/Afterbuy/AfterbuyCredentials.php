<?php


namespace App\Supplier\Afterbuy;


class AfterbuyCredentials
{
    private int $partnerId;

    private string $partnerPassword;

    private string $userId;

    private string $userPassword;

    public function getPartnerId(): int
    {
        return $this->partnerId;
    }

    public function setPartnerId(int $partnerId): void
    {
        $this->partnerId = $partnerId;
    }

    public function getPartnerPassword(): string
    {
        return $this->partnerPassword;
    }

    public function setPartnerPassword(string $partnerPassword): void
    {
        $this->partnerPassword = $partnerPassword;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserPassword(): string
    {
        return $this->userPassword;
    }

    public function setUserPassword(string $userPassword): void
    {
        $this->userPassword = $userPassword;
    }
}