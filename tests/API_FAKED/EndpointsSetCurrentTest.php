<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Endpoints\SequencesEndpoint;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call SET_CURRENT on an endpoint - faked', function (string $entity, string $action) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $id = random_int(1, 1000);
    $urlParams = ['id' => $id];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response(),
        ]);

    expect($result = $endpoint->setCurrent($id))
        ->not()->toThrow(Exception::class);
})->with([
    ['sequences', SequencesEndpoint::SET_CURRENT],
]);
