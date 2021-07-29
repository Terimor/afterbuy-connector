<?php


namespace App\Api\Entity\Request;


use App\Api\Entity\Common\ApiCategory;
use JMS\Serializer\Annotation as Serializer;

class ApiCategoryRequest implements ApiRequestInterface
{
    /** @Serializer\Type("App\Api\Entity\Common\ApiCategory") */
    private ApiCategory $category;

    public function getCategory(): ApiCategory
    {
        return $this->category;
    }
}