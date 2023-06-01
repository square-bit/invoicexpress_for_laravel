<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Data\SaftData;
use Squarebit\InvoiceXpress\API\Endpoints\SaftEndpoint;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call EXPORT on the SAFT endpoint - faked', function () {
    $endpoint = InvoiceXpress::saft();
    $cfg = $endpoint->getEndpointConfig(SaftEndpoint::EXPORT_SAFT);

    $responseSample = getResponseSample(class_basename($endpoint), SaftEndpoint::EXPORT_SAFT);

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), []) => Http::response($responseSample),
        ]);

    expect($result = $endpoint->export(fake()->year, fake()->month))
        ->not()->toThrow(Exception::class)
        ->toBeInstanceOf(SaftData::class)
        ->and($result->toArray())
        ->toMatchArrayRecursive($responseSample);
});
