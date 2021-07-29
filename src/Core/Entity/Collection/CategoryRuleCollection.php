<?php


namespace App\Core\Entity\Collection;


use App\Base\AbstractCollection;
use App\Core\Entity\CategoryRule;
use ArrayIterator;
use Traversable;

/**
 * @method CategoryRule[]|ArrayIterator|Traversable getIterator()
 * @method CategoryRule|null                        next()
 * @method CategoryRule|null                        current()
 * @method CategoryRule|null                        first()
 * @method CategoryRule|null                        last()
 * @method CategoryRule|null                        get($key)
 */
class CategoryRuleCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return CategoryRule::class;
    }

    public function filterActive(): self
    {
        return $this->filter(static fn(CategoryRule $categoryRule) => $categoryRule->isActive());
    }

    public function filterIncluding(): self
    {
        return $this->filter(static fn(CategoryRule $categoryRule) => !$categoryRule->isExcluding());
    }

    public function filterExcluding(): self
    {
        return $this->filter(static fn(CategoryRule $categoryRule) => $categoryRule->isExcluding());
    }
}