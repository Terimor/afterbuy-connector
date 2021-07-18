<?php


namespace App\Core\SupplierFacade\Afterbuy;


use App\Core\Entity\Collection\OrderCollection;
use App\Core\SupplierFacade\Afterbuy\MethodFacade\AfterbuyGetSoldItemsMethodFacade;

class AfterbuySupplierFacade
{
    private AfterbuyGetSoldItemsMethodFacade $getSoldItemsMethodFacade;

    public function __construct(AfterbuyGetSoldItemsMethodFacade $getSoldItemsMethodFacade)
    {
        $this->getSoldItemsMethodFacade = $getSoldItemsMethodFacade;
    }

    public function getSoldItems(): OrderCollection
    {
        return $this->getSoldItemsMethodFacade->commit();
    }
}