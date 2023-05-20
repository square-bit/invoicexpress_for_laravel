<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\IXClientEndpoint;
use Squarebit\InvoiceXpress\API\IXEndpoint;
use Squarebit\InvoiceXpress\API\IXEstimateEndpoint;
use Squarebit\InvoiceXpress\API\IXGuideEndpoint;
use Squarebit\InvoiceXpress\API\IXInvoiceEndpoint;
use Squarebit\InvoiceXpress\API\IXItemEndpoint;
use Squarebit\InvoiceXpress\API\IXSequenceEndpoint;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call entity actions', function (string $entity, string $action) {
    /** @var IXEndpoint $ixEntity */
    $ixEntity = InvoiceXpress::$entity();
    $endpoint = $ixEntity->getEndpoint($action);

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
    ['client', IXClientEndpoint::LIST],
    ['client', IXClientEndpoint::GET],
    ['client', IXClientEndpoint::CREATE],
    ['client', IXClientEndpoint::UPDATE],
    ['client', IXClientEndpoint::FIND_BY_NAME],
    ['client', IXClientEndpoint::LIST_INVOICES],

    ['estimate', IXEstimateEndpoint::LIST],
    ['estimate', IXEstimateEndpoint::GET],
    ['estimate', IXEstimateEndpoint::CREATE],
    ['estimate', IXEstimateEndpoint::UPDATE],
    ['estimate', IXEstimateEndpoint::SEND_BY_EMAIL],
    ['estimate', IXEstimateEndpoint::CHANGE_STATE],
    ['estimate', IXEstimateEndpoint::GENERATE_PDF],

    ['guide', IXGuideEndpoint::LIST],
    ['guide', IXGuideEndpoint::GET],
    ['guide', IXGuideEndpoint::CREATE],
    ['guide', IXGuideEndpoint::UPDATE],
    ['guide', IXGuideEndpoint::SEND_BY_EMAIL],
    ['guide', IXGuideEndpoint::CHANGE_STATE],
    ['guide', IXGuideEndpoint::GENERATE_PDF],
    ['guide', IXGuideEndpoint::GET_QRCODE],

    ['invoice', IXInvoiceEndpoint::LIST],
    ['invoice', IXInvoiceEndpoint::GET],
    ['invoice', IXInvoiceEndpoint::CREATE],
    ['invoice', IXInvoiceEndpoint::UPDATE],
    ['invoice', IXInvoiceEndpoint::SEND_BY_EMAIL],
    ['invoice', IXInvoiceEndpoint::CHANGE_STATE],
    ['invoice', IXInvoiceEndpoint::GENERATE_PDF],
    ['invoice', IXInvoiceEndpoint::GET_QRCODE],

    ['item', IXItemEndpoint::LIST],
    ['item', IXItemEndpoint::GET],
    ['item', IXItemEndpoint::CREATE],
    ['item', IXItemEndpoint::UPDATE],
    ['item', IXItemEndpoint::DELETE],

    ['sequence', IXSequenceEndpoint::LIST],
    ['sequence', IXSequenceEndpoint::GET],
    ['sequence', IXSequenceEndpoint::CREATE],
    ['sequence', IXSequenceEndpoint::UPDATE],
    ['sequence', IXSequenceEndpoint::REGISTER],
]);
