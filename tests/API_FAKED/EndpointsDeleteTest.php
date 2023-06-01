<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\TaxesEndpoint;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call DELETE on an endpoint - faked', function (string $entity, string $action) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $id = random_int(1, 1000);
    $urlParams = ['id' => $id];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response(),
        ]);

    expect($endpoint->delete($id))
        ->not()->toThrow(Exception::class)
        ->and($endpoint->getResponseCode() === 200);
})->with([
    ['items', ItemsEndpoint::DELETE],
    ['clients', ClientsEndpoint::DELETE],
    ['taxes', TaxesEndpoint::DELETE],
]);
