<?php


namespace App\Core\ApiFacade;


use App\Api\Entity\Response\ApiCategoryListResponse;
use App\Api\Entity\Response\ApiCategoryResponse;
use App\Core\ApiFacade\Bridge\Response\CategoryResponseBridge;
use App\Core\Entity\Category;
use App\Core\Repository\CategoryRepository;

class CategoryFacade
{
    private CategoryRepository $categoryRepository;

    private CategoryResponseBridge $categoryResponseBridge;

    public function __construct(CategoryRepository $categoryRepository, CategoryResponseBridge $categoryResponseBridge)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryResponseBridge = $categoryResponseBridge;
    }

    public function getAllCategories(): ApiCategoryListResponse
    {
        $response = new ApiCategoryListResponse();

        $categories = $this->categoryRepository->findAll();
        foreach ($categories as $category) {
            $apiCategory = $this->categoryResponseBridge->build($category);
            $response->addCategory($apiCategory);
        }

        return $response;
    }

    public function getCategory(Category $category): ApiCategoryResponse
    {
        $apiCategory = $this->categoryResponseBridge->build($category);

        return new ApiCategoryResponse($apiCategory);
    }
}