<?php


namespace App\Core\ApiFacade\Bridge\Response;


use App\Api\Entity\Common\ApiVolume;
use App\Core\Entity\Volume;

class VolumeResponseBridge
{
    public function build(Volume $volume): ApiVolume
    {
        $apiVolume = new ApiVolume();

        $apiVolume->setAmount($volume->getAmount());
        $apiVolume->setUnit($volume->getUnitCode()->getValue());

        return $apiVolume;
    }
}