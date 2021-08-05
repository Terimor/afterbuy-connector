<?php


namespace App\Core\Controller;


use App\Api\Builder\ApiResponseBuilder;
use App\Core\ApiFacade\SoldItemsFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class SoldItemController extends AbstractController
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

    /**
     * @Route("/sold-items/manual-sort", name="get_sold_item_list", methods={"POST"})
     */
    public function manualSort(Request $request): Response
    {
        $file = $request->files->get('file');

        $filePathname = $this->soldItemsFacade->manualSort($file);

        $response = new BinaryFileResponse($filePathname);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'sorted.zip');
        $response->headers->set('Content-Type', 'application/zip');
        $response->deleteFileAfterSend(true);

        return $response;
    }
}