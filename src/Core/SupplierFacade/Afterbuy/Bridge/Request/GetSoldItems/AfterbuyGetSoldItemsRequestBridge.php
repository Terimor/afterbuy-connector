<?php


namespace App\Core\SupplierFacade\Afterbuy\Bridge\Request\GetSoldItems;


use App\Core\Entity\AfterbuyAccount;
use App\Core\SupplierFacade\Afterbuy\Bridge\Request\AfterbuyGlobalRequestBridge;
use App\Supplier\Afterbuy\Enum\AfterbuyCallNameEnum;
use App\Supplier\Afterbuy\Request\GetSoldItems\AfterbuyGetSoldItemsRequest;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("Request")
 */
class AfterbuyGetSoldItemsRequestBridge
{
    private const DO_NOT_REQUEST = 0;

    private AfterbuyGlobalRequestBridge $globalBridge;

    public function __construct(AfterbuyGlobalRequestBridge $globalBridge)
    {
        $this->globalBridge = $globalBridge;
    }

    public function build(AfterbuyAccount $afterbuyAccount): AfterbuyGetSoldItemsRequest
    {
        $getSoldItemsRequest = new AfterbuyGetSoldItemsRequest();

        $global = $this->globalBridge->build($afterbuyAccount, AfterbuyCallNameEnum::get(AfterbuyCallNameEnum::GET_SOLD_ITEMS));
        $getSoldItemsRequest->setAfterbuyGlobal($global);

        $getSoldItemsRequest->setRequestAllItems(self::DO_NOT_REQUEST);

        return $getSoldItemsRequest;
    }
}