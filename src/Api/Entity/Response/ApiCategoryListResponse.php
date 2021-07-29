<?php


namespace App\Api\Entity\Response;


use App\Api\Entity\Common\ApiCategory;
use App\Api\Entity\Common\Collection\ApiCategoryCollection;
use JMS\Serializer\Annotation as Serializer;

class ApiCategoryListResponse extends ApiSuccessResponse
{
    /** @Serializer\Type("ArrayCollection<App\Api\Entity\Common\ApiCategory>") */
    private ApiCategoryCollection $categories;

    public function __construct()
    {
        $this->categories = new ApiCategoryCollection();
    }

    public function getCategories(): ApiCategoryCollection
    {
        return $this->categories;
    }

    public function addCategory(ApiCategory $category): void
    {
        $this->categories[] = $category;
    }
}