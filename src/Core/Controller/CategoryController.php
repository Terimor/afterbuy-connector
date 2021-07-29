<?php


namespace App\Core\Controller;


use App\Api\Builder\ApiResponseBuilder;
use App\Core\ApiFacade\CategoryFacade;
use App\Core\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    public CategoryFacade $categoryFacade;

    public ApiResponseBuilder $responseBuilder;

    public function __construct(CategoryFacade $categoryFacade, ApiResponseBuilder $responseBuilder)
    {
        $this->categoryFacade = $categoryFacade;
        $this->responseBuilder = $responseBuilder;
    }

    /**
     * @Route("categories", methods={"GET"})
     */
    public function getAllCategories(): Response
    {
        $response = $this->categoryFacade->getAllCategories();

        return $this->responseBuilder->build($response);
    }

    /**
     * @Route("categories/{id}", requirements={"id"="\d+"}, name="get_category", methods={"GET"})
     * @ParamConverter("category", class="App\Core\Entity\Category")
     */
    public function getCategory(Category $category): Response
    {
        $response = $this->categoryFacade->getCategory($category);

        return $this->responseBuilder->build($response);
    }
}