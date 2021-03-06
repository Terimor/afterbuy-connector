<?php


namespace App\Api\Entity\Response;


use App\Api\Entity\Common\ApiCategory;
use JMS\Serializer\Annotation as Serializer;

class ApiCategoryResponse extends ApiSuccessResponse
{
    /** @Serializer\Type("App\Api\Entity\Common\ApiCategory") */
    private ApiCategory $category;

    public function __construct(ApiCategory $category)
    {
        $this->category = $category;
    }
}