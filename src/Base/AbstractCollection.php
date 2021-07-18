<?php


namespace App\Base;


use Doctrine\Common\Collections\ArrayCollection;
use InvalidArgumentException;

abstract class AbstractCollection extends ArrayCollection
{
    public function __construct(array $elements = [])
    {
        if ($elements && !$this->isValid($elements)) {
            $this->throwInvalidObjectClassException();
        }

        parent::__construct($elements);
    }

    abstract protected function getClassName(): string;

    public function isValid($values): bool
    {
        if (!$values) {
            return false;
        }

        if (!is_array($values)) {
            $values = [$values];
        }

        foreach ($values as $value) {
            $className = $this->getClassName();
            if (!$value instanceof $className) {
                return false;
            }
        }

        return true;
    }

    protected function throwInvalidObjectClassException(): void
    {
        throw new InvalidArgumentException('Elements must be of type '.$this->getClassName());
    }

    public function offsetSet($offset, $value): void
    {
        if (!$this->isValid($value)) {
            $this->throwInvalidObjectClassException();
        }

        parent::offsetSet($offset, $value);
    }

    public function set($key, $value): void
    {
        if (!$this->isValid($value)) {
            $this->throwInvalidObjectClassException();
        }

        parent::set($key, $value);
    }

    public function add($element): void
    {
        if (!$this->isValid($element)) {
            $this->throwInvalidObjectClassException();
        }

        parent::add($element);
    }

    public function addUnique($element): void
    {
        if (!$this->contains($element)) {
            $this->add($element);
        }
    }

    public function addCollection(AbstractCollection $collectionToMerge): void
    {
        foreach ($collectionToMerge as $item) {
            $this->add($item);
        }
    }

    public function addUniqueCollection(AbstractCollection $collectionToMerge): void
    {
        foreach ($collectionToMerge as $item) {
            $this->addUnique($item);
        }
    }

    public function isContainsCollection(AbstractCollection $otherCollection): bool
    {
        foreach ($otherCollection as $otherObject) {
            if (!$this->contains($otherObject)) {
                return false;
            }
        }

        return true;
    }

    public function dropValuesKeys(): self
    {
        $array = $this->getValues();
        $className = get_class($this);

        return new $className($array);
    }
}