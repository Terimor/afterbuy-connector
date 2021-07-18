<?php


namespace App\Core\Entity\Collection;


use App\Base\AbstractCollection;
use App\Core\Entity\Category;

class CategoryCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return Category::class;
    }
}