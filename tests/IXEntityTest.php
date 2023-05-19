<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\IXClient;
use Squarebit\InvoiceXpress\API\IXEndpoint;
use Squarebit\InvoiceXpress\API\IXEstimate;
use Squarebit\InvoiceXpress\API\IXGuide;
use Squarebit\InvoiceXpress\API\IXInvoice;
use Squarebit\InvoiceXpress\API\IXItem;
use Squarebit\InvoiceXpress\API\IXSequence;
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
    ['client', IXClient::LIST],
    ['client', IXClient::GET],
    ['client', IXClient::CREATE],
    ['client', IXClient::UPDATE],
    ['client', IXClient::FIND_BY_NAME],
    ['client', IXClient::LIST_INVOICES],

    ['estimate', IXEstimate::LIST],
    ['estimate', IXEstimate::GET],
    ['estimate', IXEstimate::CREATE],
    ['estimate', IXEstimate::UPDATE],
    ['estimate', IXEstimate::SEND_BY_EMAIL],
    ['estimate', IXEstimate::CHANGE_STATE],
    ['estimate', IXEstimate::GENERATE_PDF],

    ['guide', IXGuide::LIST],
    ['guide', IXGuide::GET],
    ['guide', IXGuide::CREATE],
    ['guide', IXGuide::UPDATE],
    ['guide', IXGuide::SEND_BY_EMAIL],
    ['guide', IXGuide::CHANGE_STATE],
    ['guide', IXGuide::GENERATE_PDF],
    ['guide', IXGuide::GET_QRCODE],

    ['invoice', IXInvoice::LIST],
    ['invoice', IXInvoice::GET],
    ['invoice', IXInvoice::CREATE],
    ['invoice', IXInvoice::UPDATE],
    ['invoice', IXInvoice::SEND_BY_EMAIL],
    ['invoice', IXInvoice::CHANGE_STATE],
    ['invoice', IXInvoice::GENERATE_PDF],
    ['invoice', IXInvoice::GET_QRCODE],

    ['item', IXItem::LIST],
    ['item', IXItem::GET],
    ['item', IXItem::CREATE],
    ['item', IXItem::UPDATE],
    ['item', IXItem::DELETE],

    ['sequence', IXSequence::LIST],
    ['sequence', IXSequence::GET],
    ['sequence', IXSequence::CREATE],
    ['sequence', IXSequence::UPDATE],
    ['sequence', IXSequence::REGISTER],
]);
