<?php


namespace App\Supplier\Afterbuy\Response\GetSoldItems;

use App\Supplier\Afterbuy\Enum\AfterbuyCallStatusEnum;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("Afterbuy")
 */
class AfterbuyGetSoldItemsResponse
{
    /**
     * @var string|AfterbuyCallStatusEnum
     * @Serializer\Type("string")
     */
    private $CallStatus;

    /** @Serializer\Type("App\Supplier\Afterbuy\Response\GetSoldItems\AfterbuyResultResponse") */
    private AfterbuyResultResponse $Result;

    public function getCallStatus(): AfterbuyCallStatusEnum
    {
        if (!$this->CallStatus instanceof AfterbuyCallStatusEnum) {
            $this->CallStatus = AfterbuyCallStatusEnum::get($this->CallStatus);
        }

        return $this->CallStatus;
    }

    public function getResult(): AfterbuyResultResponse
    {
        return $this->Result;
    }
}