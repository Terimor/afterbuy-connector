<?php


namespace App\Core\Controller;


use App\Api\Builder\ApiResponseBuilder;
use App\Core\ApiFacade\CatalogFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    private CatalogFacade $catalogFacade;

    private ApiResponseBuilder $responseBuilder;

    public function __construct(CatalogFacade $catalogFacade, ApiResponseBuilder $responseBuilder)
    {
        $this->catalogFacade = $catalogFacade;
        $this->responseBuilder = $responseBuilder;
    }

    /**
     * @Route("/catalogs", name="get_all_catalogs", methods={"GET"})
     */
    public function getAll(): Response
    {
        $response = $this->catalogFacade->getAll();

        return $this->responseBuilder->build($response);
    }
}