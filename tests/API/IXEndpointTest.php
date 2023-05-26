<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call endpoint actions (FAKED)', function (string $entity, string $action) {
    /** @var Endpoint $ixEntity */
    $ixEntity = InvoiceXpress::$entity();
    $endpoint = $ixEntity->getEndpointConfig($action);

    $requestSample = getRequestSample(class_basename($ixEntity), $action);
    $responseSample = getResponseSample(class_basename($ixEntity), $action);

    Http::preventStrayRequests();
    Http::fake([
        UriTemplate::expand($endpoint->getUrl(), []) => Http::response($responseSample, 200),
    ]);

    expect($ixEntity->call($action, bodyData: $requestSample))
        ->not()->toThrow(Exception::class)
        ->toEqual($responseSample);
})->with([
    ['clients', ClientsEndpoint::LIST],
    ['clients', ClientsEndpoint::GET],
    ['clients', ClientsEndpoint::CREATE],
    ['clients', ClientsEndpoint::UPDATE],
    ['clients', ClientsEndpoint::FIND_BY_NAME],
    ['clients', ClientsEndpoint::LIST_INVOICES],

    //    ['estimate', IXEstimateEndpoint::LIST],
    //    ['estimate', IXEstimateEndpoint::GET],
    //    ['estimate', IXEstimateEndpoint::CREATE],
    //    ['estimate', IXEstimateEndpoint::UPDATE],
    //    ['estimate', IXEstimateEndpoint::SEND_BY_EMAIL],
    //    ['estimate', IXEstimateEndpoint::CHANGE_STATE],
    //    ['estimate', IXEstimateEndpoint::GENERATE_PDF],
    //
    //    ['guide', IXGuideEndpoint::LIST],
    //    ['guide', IXGuideEndpoint::GET],
    //    ['guide', IXGuideEndpoint::CREATE],
    //    ['guide', IXGuideEndpoint::UPDATE],
    //    ['guide', IXGuideEndpoint::SEND_BY_EMAIL],
    //    ['guide', IXGuideEndpoint::CHANGE_STATE],
    //    ['guide', IXGuideEndpoint::GENERATE_PDF],
    //    ['guide', IXGuideEndpoint::GET_QRCODE],

    ['invoices', InvoicesEndpoint::LIST],
    ['invoices', InvoicesEndpoint::GET],
    ['invoices', InvoicesEndpoint::CREATE],
    ['invoices', InvoicesEndpoint::UPDATE],
    ['invoices', InvoicesEndpoint::SEND_BY_EMAIL],
    ['invoices', InvoicesEndpoint::CHANGE_STATE],
    ['invoices', InvoicesEndpoint::GENERATE_PDF],
    ['invoices', InvoicesEndpoint::GET_QRCODE],

    ['items', ItemsEndpoint::LIST],
    ['items', ItemsEndpoint::GET],
    ['items', ItemsEndpoint::CREATE],
    ['items', ItemsEndpoint::UPDATE],
    ['items', ItemsEndpoint::DELETE],

    //    ['sequence', IXSequenceEndpoint::LIST],
    //    ['sequence', IXSequenceEndpoint::GET],
    //    ['sequence', IXSequenceEndpoint::CREATE],
    //    ['sequence', IXSequenceEndpoint::UPDATE],
    //    ['sequence', IXSequenceEndpoint::REGISTER],
]);
