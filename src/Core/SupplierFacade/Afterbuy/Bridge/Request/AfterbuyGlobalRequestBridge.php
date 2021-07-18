<?php


namespace App\Core\SupplierFacade\Afterbuy\Bridge\Request;


use App\Supplier\Afterbuy\Enum\AfterbuyCallNameEnum;
use App\Supplier\Afterbuy\Request\GetSoldItems\AfterbuyGlobalRequest;
use App\Supplier\AfterbuyConfig;

class AfterbuyGlobalRequestBridge
{
    private const DETAIL_LEVEL = 0;
    private const LANGUAGE_EN = 'EN';

    private AfterbuyConfig $config;

    public function __construct(AfterbuyConfig $config)
    {
        $this->config = $config;
    }

    public function build(AfterbuyCallNameEnum $callNameEnum): AfterbuyGlobalRequest
    {
        $afterbuyGlobal = new AfterbuyGlobalRequest();

        $afterbuyGlobal->setPartnerID($this->config->getPartnerId());
        $afterbuyGlobal->setPartnerPassword($this->config->getPartnerPassword());
        $afterbuyGlobal->setUserID($this->config->getUserId());
        $afterbuyGlobal->setUserPassword($this->config->getUserPassword());
        $afterbuyGlobal->setDetailLevel(self::DETAIL_LEVEL);
        $afterbuyGlobal->setErrorLanguage(self::LANGUAGE_EN);

        $afterbuyGlobal->setCallName($callNameEnum->getValue());

        return $afterbuyGlobal;
    }
}