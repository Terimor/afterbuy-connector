<?php


namespace App\Core\Controller;


use App\Api\Builder\ApiResponseBuilder;
use App\Core\ApiFacade\SoldItemsFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class SoldItemsController extends AbstractController
{
    private SoldItemsFacade $soldItemsFacade;

    private ApiResponseBuilder $responseBuilder;

    public function __construct(SoldItemsFacade $soldItemsFacade, ApiResponseBuilder $responseBuilder)
    {
        $this->soldItemsFacade = $soldItemsFacade;
        $this->responseBuilder = $responseBuilder;
    }

    /**
     * @Route("/sold-items", name="get_sold_item_list", methods={"GET"})
     */
    public function getAll(): Response
    {
        $soldItemsResponse = $this->soldItemsFacade->getAll();

        return $this->responseBuilder->build($soldItemsResponse);
    }
}