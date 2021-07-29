<?php


namespace App\Core\ApiFacade;


use App\Api\Entity\Request\ApiCategoryRequest;
use App\Api\Entity\Response\ApiCategoryListResponse;
use App\Api\Entity\Response\ApiCategoryResponse;
use App\Api\Entity\Response\ApiSuccessResponse;
use App\Core\ApiFacade\Bridge\Request\CategoryRequestBridge;
use App\Core\ApiFacade\Bridge\Response\CategoryResponseBridge;
use App\Core\Entity\Category;
use App\Core\Repository\CategoryRepository;

class CategoryFacade
{
    private CategoryRepository $categoryRepository;

    private CategoryRequestBridge $categoryRequestBridge;

    private CategoryResponseBridge $categoryResponseBridge;

    public function __construct(
        CategoryRepository $categoryRepository,
        CategoryRequestBridge $categoryRequestBridge,
        CategoryResponseBridge $categoryResponseBridge
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->categoryRequestBridge = $categoryRequestBridge;
        $this->categoryResponseBridge = $categoryResponseBridge;
    }

    public function getAll(): ApiCategoryListResponse
    {
        $response = new ApiCategoryListResponse();

        $categories = $this->categoryRepository->findAll();
        foreach ($categories as $category) {
            $apiCategory = $this->categoryResponseBridge->build($category);
            $response->addCategory($apiCategory);
        }

        return $response;
    }

    public function getOne(Category $category): ApiCategoryResponse
    {
        $apiCategory = $this->categoryResponseBridge->build($category);

        return new ApiCategoryResponse($apiCategory);
    }

    public function update(ApiCategoryRequest $categoryRequest): ApiSuccessResponse
    {
        $apiCategory = $categoryRequest->getCategory();

        $category = $this->categoryRequestBridge->build($apiCategory);
        $this->categoryRepository->save($category);

        return new ApiSuccessResponse();
    }
}