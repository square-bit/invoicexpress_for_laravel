<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call GENERATE_PDF on an endpoint - faked', function (string $entity, string $action, int $responseCode) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $responseSample = $responseCode === 200 ? getResponseSample(class_basename($endpoint), $action) : null;
    $id = random_int(1, 1000);
    $urlParams = ['id' => $id];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl().'&second_copy=*', $urlParams) => Http::response($responseSample, $responseCode),
        ]);

    expect($result = $endpoint->generatePDF($id, fake()->boolean()))
        ->not()->toThrow(Exception::class)
        ->and($result?->toArray())
        ->toMatchArrayRecursive($responseSample ? reset($responseSample) : []);
})->with([
    ['estimates', EstimatesEndpoint::GENERATE_PDF],
    ['guides', GuidesEndpoint::GENERATE_PDF],
    ['invoices', InvoicesEndpoint::GENERATE_PDF],
])->with([
    'Response OK' => 200,
    'Response ACCEPTED' => 202,
]);
