<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\IXClientEndpoint;
use Squarebit\InvoiceXpress\API\IXEndpoint;
use Squarebit\InvoiceXpress\API\IXInvoiceEndpoint;
use Squarebit\InvoiceXpress\API\IXItemEndpoint;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call endpoint actions (FAKED)', function (string $entity, string $action) {
    /** @var IXEndpoint $ixEntity */
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
    ['clients', IXClientEndpoint::LIST],
    ['clients', IXClientEndpoint::GET],
    ['clients', IXClientEndpoint::CREATE],
    ['clients', IXClientEndpoint::UPDATE],
    ['clients', IXClientEndpoint::FIND_BY_NAME],
    ['clients', IXClientEndpoint::LIST_INVOICES],

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

    ['invoices', IXInvoiceEndpoint::LIST],
    ['invoices', IXInvoiceEndpoint::GET],
    ['invoices', IXInvoiceEndpoint::CREATE],
    ['invoices', IXInvoiceEndpoint::UPDATE],
    ['invoices', IXInvoiceEndpoint::SEND_BY_EMAIL],
    ['invoices', IXInvoiceEndpoint::CHANGE_STATE],
    ['invoices', IXInvoiceEndpoint::GENERATE_PDF],
    ['invoices', IXInvoiceEndpoint::GET_QRCODE],

    ['items', IXItemEndpoint::LIST],
    ['items', IXItemEndpoint::GET],
    ['items', IXItemEndpoint::CREATE],
    ['items', IXItemEndpoint::UPDATE],
    ['items', IXItemEndpoint::DELETE],

    //    ['sequence', IXSequenceEndpoint::LIST],
    //    ['sequence', IXSequenceEndpoint::GET],
    //    ['sequence', IXSequenceEndpoint::CREATE],
    //    ['sequence', IXSequenceEndpoint::UPDATE],
    //    ['sequence', IXSequenceEndpoint::REGISTER],
]);
