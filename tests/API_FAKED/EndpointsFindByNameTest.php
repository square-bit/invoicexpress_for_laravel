<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call FIND_BY_CODE on an endpoint - faked', function (string $entity, string $action, string $entityDataClass) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $responseSample = getResponseSample(class_basename($endpoint), $action);
    $name = $responseSample[array_keys($responseSample)[0]]['name'];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl().'&client_name='.urlencode($name), []) => Http::response($responseSample),
        ]);

    expect($result = $endpoint->findByName($name))
        ->not()->toThrow(Exception::class)
        ->toBeInstanceOf($entityDataClass)
        ->and($result->toArray())
        ->toMatchArrayRecursive($responseSample[array_keys($responseSample)[0]]);
})->with([
    ['clients', ClientsEndpoint::FIND_BY_NAME, ClientData::class],
]);
