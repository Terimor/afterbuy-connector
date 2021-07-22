<?php

namespace App\Api\Entity\Response;

use App\Api\Entity\Common\Collection\ApiSoldItemCollection;
use JMS\Serializer\Annotation as Serializer;

class ApiSoldItemsResponse implements ApiResponseInterface
{
    /** @Serializer\Type("ArrayCollection<App\Api\Entity\Common\ApiSoldItem>") */
    private ApiSoldItemCollection $soldItems;

    public function __construct(ApiSoldItemCollection $soldItems)
    {
        $this->soldItems = $soldItems;
    }
}