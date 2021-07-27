<?php


namespace App\Core\Manager\Service;


use App\Core\Entity\SoldItem;

class ProductCodeParserService
{
    private const PRODUCT_CODE_REGEX = '#\s+((?:W|SL)\d{3})#';

    public function parseProductCode(SoldItem $soldItem): ?string
    {
        preg_match(self::PRODUCT_CODE_REGEX, $soldItem->getTitle(), $matches);

        dump($matches);
        return $matches[1] ?? null;
    }
}