<?php


namespace App\Core\SupplierFacade\Afterbuy\Bridge\Request;


use App\Core\Entity\AfterbuyAccount;
use App\Supplier\Afterbuy\Enum\AfterbuyCallNameEnum;
use App\Supplier\Afterbuy\Request\GetSoldItems\AfterbuyGlobalRequest;

class AfterbuyGlobalRequestBridge
{
    private const DETAIL_LEVEL = 0;
    private const LANGUAGE_EN = 'EN';

    public function build(AfterbuyAccount $afterbuyAccount, AfterbuyCallNameEnum $callNameEnum): AfterbuyGlobalRequest
    {
        $afterbuyGlobal = new AfterbuyGlobalRequest();

        $afterbuyGlobal->setPartnerID($afterbuyAccount->getPartnerId());
        $afterbuyGlobal->setPartnerPassword($afterbuyAccount->getPartnerPassword());
        $afterbuyGlobal->setUserID($afterbuyAccount->getUserId());
        $afterbuyGlobal->setUserPassword($afterbuyAccount->getUserPassword());
        $afterbuyGlobal->setDetailLevel(self::DETAIL_LEVEL);
        $afterbuyGlobal->setErrorLanguage(self::LANGUAGE_EN);

        $afterbuyGlobal->setCallName($callNameEnum->getValue());

        return $afterbuyGlobal;
    }
}