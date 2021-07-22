<?php


namespace App\Core\Entity\Collection;


use App\Base\AbstractCollection;
use App\Core\Entity\CategoryRuleEntry;
use ArrayIterator;
use Traversable;

/**
 * @method CategoryRuleEntry[]|ArrayIterator|Traversable getIterator()
 * @method CategoryRuleEntry|null                        next()
 * @method CategoryRuleEntry|null                        current()
 * @method CategoryRuleEntry|null                        first()
 * @method CategoryRuleEntry|null                        last()
 * @method CategoryRuleEntry|null                        get($key)
 */
class CategoryRuleEntryCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return CategoryRuleEntry::class;
    }

    public function filterByIncluded(): self
    {
        return $this->filter(static fn(CategoryRuleEntry $categoryRuleEntry) => !$categoryRuleEntry->isExcluding());
    }

    public function filterByExcluded(): self
    {
        return $this->filter(static fn(CategoryRuleEntry $categoryRuleEntry) => $categoryRuleEntry->isExcluding());
    }
}