<?php


namespace App\Core\Controller;


use App\Api\Builder\ApiRequestBuilder;
use App\Api\Builder\ApiResponseBuilder;
use App\Api\Entity\Request\ApiCategoryRequest;
use App\Core\ApiFacade\CategoryFacade;
use App\Core\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    public CategoryFacade $categoryFacade;

    public ApiRequestBuilder $requestBuilder;

    public ApiResponseBuilder $responseBuilder;

    public function __construct(CategoryFacade $categoryFacade, ApiRequestBuilder $requestBuilder, ApiResponseBuilder $responseBuilder)
    {
        $this->categoryFacade = $categoryFacade;
        $this->requestBuilder = $requestBuilder;
        $this->responseBuilder = $responseBuilder;
    }

    /**
     * @Route("categories", name="get_all_categories", methods={"GET"})
     */
    public function getAll(): Response
    {
        $response = $this->categoryFacade->getAll();

        return $this->responseBuilder->build($response);
    }

    /**
     * @Route("categories/{id}", requirements={"id"="\d+"}, name="get_category", methods={"GET"})
     * @ParamConverter("category", class="App\Core\Entity\Category")
     */
    public function getOne(Category $category): Response
    {
        $response = $this->categoryFacade->getOne($category);

        return $this->responseBuilder->build($response);
    }

    /**
     * @Route("categories", name="create_category", methods={"POST"})
     */
    public function createCategory(Request $request): Response
    {
        $data = $request->getContent();
        /** @var ApiCategoryRequest $requestEntity */
        $requestEntity = $this->requestBuilder->build($data, ApiCategoryRequest::class);

        $response = $this->categoryFacade->create($requestEntity);

        return $this->responseBuilder->build($response);
    }

    /**
     * @Route("categories", name="update_category", methods={"PUT"})
     */
    public function update(Request $request): Response
    {
        $data = $request->getContent();
        /** @var ApiCategoryRequest $requestEntity */
        $requestEntity = $this->requestBuilder->build($data, ApiCategoryRequest::class);

        $response = $this->categoryFacade->update($requestEntity);

        return $this->responseBuilder->build($response);
    }
}