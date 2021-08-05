<?php


namespace App\Core\Service;


use App\Core\Entity\SoldItem;
use App\Core\Entity\Volume;
use App\Core\Enum\UnitEnum;

class VolumeParserService
{
    private const VOLUME_REGEX = '#(\d+(?:[\.,]{0,1})\d*)(kg|l)#i';
    private const VOLUME_RANGE_REGEX = '#(\d+(?:[\.,]{0,1})\d*)(kg|l)*\s*-\s*(\d+(?:[\.,]{0,1})\d*)(kg|l)#i';

    private const MAX_TRUTHFUL_VOLUME_LIMIT = 25;

    public function parseVolume(SoldItem $soldItem): ?Volume
    {
        $stringToParseVolume = $this->getStringToParseVolume($soldItem);
        preg_match(self::VOLUME_REGEX, $stringToParseVolume, $matches);

        if (isset($matches[1], $matches[2]) && (float)$matches[2] <= self::MAX_TRUTHFUL_VOLUME_LIMIT) {
            $amount = (float)str_replace(',', '.', $matches[1]);
            $unit = strtolower($matches[2]);

            return $this->buildVolume($amount, $unit);
        }

        return null;
    }

    //excluding range volumes
    private function getStringToParseVolume(SoldItem $soldItem): string
    {
        return preg_replace(self::VOLUME_RANGE_REGEX, '', $soldItem->getTitle());
    }

    private function buildVolume(float $amount, string $unit): Volume
    {
        $volume = new Volume();

        $volume->setAmount($amount);
        $volume->setUnitCode(UnitEnum::get($unit));

        return $volume;
    }
}