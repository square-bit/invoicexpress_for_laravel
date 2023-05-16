<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;
use Squarebit\InvoiceXpress\Models\IXClient;
use Squarebit\InvoiceXpress\Models\IXItem;
use Squarebit\InvoiceXpress\Models\IXSequence;

it('can call entity actions', function (string $entity, string $action) {
    /** @var IXClient $client */
    $client = InvoiceXpress::$entity();
    $endpoint = $client->getEndpoint($action);

    $requestSample = getRequestSample(class_basename($client), $action);
    $responseSample = getResponseSample(class_basename($client), $action);

    Http::preventStrayRequests();
    Http::fake([
        UriTemplate::expand($endpoint->getUrl(), []) => Http::response($responseSample, 200),
    ]);

    expect($client->call($action, bodyData: $requestSample))
        ->not()->toThrow(Exception::class)
        ->toEqual($responseSample);
})->with([
    ['client', IXClient::LIST],
    ['client', IXClient::GET],
    ['client', IXClient::CREATE],
    ['client', IXClient::UPDATE],
    ['client', IXClient::FIND_BY_NAME],
    ['client', IXClient::LIST_INVOICES],

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
