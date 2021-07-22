<?php


namespace App\Core\SupplierFacade\Afterbuy\MethodFacade;


use App\Core\Entity\AfterbuyAccount;
use App\Core\Entity\Collection\OrderCollection;
use App\Core\SupplierFacade\Afterbuy\Bridge\Request\GetSoldItems\AfterbuyGetSoldItemsRequestBridge;
use App\Core\SupplierFacade\Afterbuy\Bridge\Response\GetSoldItems\AfterbuyGetSoldItemsResponseBridge;
use App\Supplier\Afterbuy\Response\GetSoldItems\AfterbuyGetSoldItemsResponse;
use App\Supplier\Afterbuy\Serializer\AfterbuySerializerBuilder;
use App\Supplier\AfterbuyConfig;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;

class AfterbuyGetSoldItemsMethodFacade
{
    private AfterbuyGetSoldItemsRequestBridge $requestBridge;

    private AfterbuyGetSoldItemsResponseBridge $responseBridge;

    private SerializerInterface $serializer;

    private AfterbuyConfig $config;

    public function __construct(
        AfterbuyGetSoldItemsRequestBridge $requestBridge,
        AfterbuyGetSoldItemsResponseBridge $responseBridge,
        AfterbuySerializerBuilder $serializerBuilder,
        AfterbuyConfig $config
    ) {
        $this->requestBridge = $requestBridge;
        $this->responseBridge = $responseBridge;
        $this->serializer = $serializerBuilder->build();
        $this->config = $config;
    }

    public function commit(AfterbuyAccount $afterbuyAccount): OrderCollection
    {
        $request = $this->requestBridge->build($afterbuyAccount);

        $requestBody = $this->serializer->serialize($request, 'xml');

        $stringResponse = $this->sendAndGetStringResponse($requestBody);

        /** @var AfterbuyGetSoldItemsResponse $response */
        $response = $this->serializer->deserialize($stringResponse, AfterbuyGetSoldItemsResponse::class, 'xml');

        return $this->responseBridge->build($response);
    }

    private function sendAndGetStringResponse(string $body): string
    {
        $client = new Client(['base_uri' => $this->config->getUrl()]);

        $response = $client->post('', ['body' => $body]);

        return $response->getBody();
    }
}