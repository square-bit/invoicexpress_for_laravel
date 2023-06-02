<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call RELATED_DOCUMENTS on an endpoint - faked', function (string $entity, string $action, string $entityDataClass) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $responseSample = getResponseSample(class_basename($endpoint), $action);
    $id = reset($responseSample)[0]['id'];
    $urlParams = ['id' => $id];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response($responseSample),
        ]);

    expect($result = $endpoint->getRelatedDocuments($id))
        ->not()->toThrow(Exception::class)
        ->toBeInstanceOf($entityDataClass)
        ->and($result->items()->toArray())
        ->toMatchArrayRecursive(reset($responseSample));
})->with([
    ['invoices', InvoicesEndpoint::RELATED_DOCUMENTS, EntityListData::class],
]);
