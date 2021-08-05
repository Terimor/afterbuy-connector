<?php


namespace App\Core\Entity\Collection;


use App\Base\AbstractCollection;
use App\Core\Entity\Category;
use ArrayIterator;
use Traversable;

/**
 * @method Category[]|ArrayIterator|Traversable getIterator()
 * @method Category|null                        next()
 * @method Category|null                        current()
 * @method Category|null                        first()
 * @method Category|null                        last()
 * @method Category|null                        get($key)
 */
class CategoryCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return Category::class;
    }
}