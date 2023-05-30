<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\SequencesEndpoint;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call endpoint actions (FAKED)', function (string $entity, string $action) {
    /** @var Endpoint $ixEntity */
    $ixEntity = InvoiceXpress::$entity();
    $endpoint = $ixEntity->getEndpointConfig($action);

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
    ['clients', ClientsEndpoint::LIST],
    ['clients', ClientsEndpoint::GET],
    ['clients', ClientsEndpoint::CREATE],
    ['clients', ClientsEndpoint::UPDATE],
    ['clients', ClientsEndpoint::FIND_BY_NAME],
    ['clients', ClientsEndpoint::LIST_INVOICES],

    ['estimates', EstimatesEndpoint::LIST],
    ['estimates', EstimatesEndpoint::GET],
    ['estimates', EstimatesEndpoint::CREATE],
    ['estimates', EstimatesEndpoint::UPDATE],
    ['estimates', EstimatesEndpoint::SEND_BY_EMAIL],
    ['estimates', EstimatesEndpoint::CHANGE_STATE],
    ['estimates', EstimatesEndpoint::GENERATE_PDF],

    ['guides', GuidesEndpoint::LIST],
    ['guides', GuidesEndpoint::GET],
    ['guides', GuidesEndpoint::CREATE],
    ['guides', GuidesEndpoint::UPDATE],
    ['guides', GuidesEndpoint::SEND_BY_EMAIL],
    ['guides', GuidesEndpoint::CHANGE_STATE],
    ['guides', GuidesEndpoint::GENERATE_PDF],
    ['guides', GuidesEndpoint::GET_QRCODE],

    ['invoices', InvoicesEndpoint::LIST],
    ['invoices', InvoicesEndpoint::GET],
    ['invoices', InvoicesEndpoint::CREATE],
    ['invoices', InvoicesEndpoint::UPDATE],
    ['invoices', InvoicesEndpoint::SEND_BY_EMAIL],
    ['invoices', InvoicesEndpoint::CHANGE_STATE],
    ['invoices', InvoicesEndpoint::GENERATE_PDF],
    ['invoices', InvoicesEndpoint::GET_QRCODE],

    ['items', ItemsEndpoint::LIST],
    ['items', ItemsEndpoint::GET],
    ['items', ItemsEndpoint::CREATE],
    ['items', ItemsEndpoint::UPDATE],
    ['items', ItemsEndpoint::DELETE],

    ['sequences', SequencesEndpoint::LIST],
    ['sequences', SequencesEndpoint::GET],
    ['sequences', SequencesEndpoint::CREATE],
    ['sequences', SequencesEndpoint::UPDATE],
    ['sequences', SequencesEndpoint::REGISTER],
]);
