<?php


namespace App\Core\Entity\Collection;


use App\Base\AbstractCollection;
use App\Core\Entity\Category;
use App\Core\Entity\SoldItem;
use ArrayIterator;
use Traversable;

/**
 * @method SoldItem[]|ArrayIterator|Traversable getIterator()
 * @method SoldItem|null                        next()
 * @method SoldItem|null                        current()
 * @method SoldItem|null                        first()
 * @method SoldItem|null                        last()
 * @method SoldItem|null                        get($key)
 */
class SoldItemCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return SoldItem::class;
    }

    public function filterByCategory(Category $category): self
    {
        return $this->filter(static fn(SoldItem $soldItem) => $soldItem->getCategory() === $category);
    }

    public function filterByNullCategory(): self
    {
        return $this->filter(static fn(SoldItem $soldItem) => $soldItem->getCategory() === null);
    }

    public function calculateTotalVolumeAmount(): float
    {
        $result = 0.0;

        foreach ($this as $soldItem) {
            if ($soldItem->getVolume()) {
                $result += $soldItem->getVolume()->getAmount() * $soldItem->getQuantity();
            }
        }

        return $result;
    }
}