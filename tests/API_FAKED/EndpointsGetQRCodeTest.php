<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call GET_QRCODE on an endpoint - faked', function (string $entity, string $action) {
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

    expect($result = $endpoint->getQRCode($id, fake()->boolean()))
        ->not()->toThrow(Exception::class)
        ->and($result->toArray())
        ->toMatchArrayRecursive(reset($responseSample));
})->with([
    ['guides', GuidesEndpoint::GET_QRCODE],
    ['invoices', InvoicesEndpoint::GET_QRCODE],
]);
