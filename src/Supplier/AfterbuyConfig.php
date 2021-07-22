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

    public function getUrl(): string
    {
        return (string)$this->params->get('afterbuy.url');
    }
}