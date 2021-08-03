<?php


namespace App\Api\Entity\Common;


use JMS\Serializer\Annotation as Serializer;

class ApiCatalogItem
{
    /** @Serializer\Type("string") */
    private string $id;

    /** @Serializer\Type("string") */
    private string $label;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }
}