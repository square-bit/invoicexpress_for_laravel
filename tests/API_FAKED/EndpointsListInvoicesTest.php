<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Data\Filters\ClientListInvoicesFilter;
use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call LIST_INVOICES on an endpoint - faked', function (string $entity, string $action, string $entityDataClass) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $responseSample = getResponseSample(class_basename($endpoint), $action);
    $id = random_int(1, 1000);
    $urlParams = ['id' => $id];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response($responseSample),
        ]);

    expect($result = $endpoint->listInvoices($id, ClientListInvoicesFilter::from([])))
        ->not()->toThrow(Exception::class)
        ->toBeInstanceOf($entityDataClass)
        ->and($result->items()->toArray())
        ->toMatchArrayRecursive($responseSample[array_keys($responseSample)[0]]);
})->with([
    ['clients', ClientsEndpoint::LIST_INVOICES, EntityListData::class],
]);
