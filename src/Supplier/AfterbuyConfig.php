<?php


namespace App\Supplier;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class AfterbuyConfig
{
    private ParameterBagInterface $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function getPartnerId(): int
    {
        return (int)$this->params->get('afterbuy.partner_id');
    }

    public function getPartnerPassword(): string
    {
        return (string)$this->params->get('afterbuy.partner_password');
    }

    public function getUserId(): string
    {
        return (string)$this->params->get('afterbuy.user_id');
    }

    public function getUserPassword(): string
    {
        return (string)$this->params->get('afterbuy.user_password');
    }

    public function getUrl(): string
    {
        return (string)$this->params->get('afterbuy.url');
    }
}