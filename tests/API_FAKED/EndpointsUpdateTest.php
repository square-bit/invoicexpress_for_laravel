<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\API\Data\EstimateData;
use Squarebit\InvoiceXpress\API\Data\GuideData;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Data\TaxData;
use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\TaxesEndpoint;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call UPDATE on an endpoint - faked', function (string $entity, string $action, EntityTypeEnum $type, string $entityDataClass) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $requestSample = getRequestSample(class_basename($endpoint), $action);
    $id = $requestSample['id'];
    $urlParams = ['id' => $id, 'type' => $type?->toUrlVariable()];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response(),
        ]);

    $data = $entityDataClass::from($requestSample);

    expect($endpoint->update($type, $data))
        ->not()->toThrow(Exception::class)
        ->and($endpoint->getResponseCode() === 200);
})->with([
    ['items', ItemsEndpoint::UPDATE, EntityTypeEnum::Item, ItemData::class],
    ['clients', ClientsEndpoint::UPDATE, EntityTypeEnum::Client, ClientData::class],
    ['taxes', TaxesEndpoint::UPDATE, EntityTypeEnum::Tax, TaxData::class],
    ['estimates', EstimatesEndpoint::UPDATE, EntityTypeEnum::Quote, EstimateData::class],
    ['estimates', EstimatesEndpoint::UPDATE, EntityTypeEnum::Proforma, EstimateData::class],
    ['estimates', EstimatesEndpoint::UPDATE, EntityTypeEnum::FeesNote, EstimateData::class],
    ['guides', GuidesEndpoint::UPDATE, EntityTypeEnum::Shipping, GuideData::class],
    ['guides', GuidesEndpoint::UPDATE, EntityTypeEnum::Transport, GuideData::class],
    ['guides', GuidesEndpoint::UPDATE, EntityTypeEnum::Devolution, GuideData::class],
    ['invoices', InvoicesEndpoint::UPDATE, EntityTypeEnum::Invoice, InvoiceData::class],
    ['invoices', InvoicesEndpoint::UPDATE, EntityTypeEnum::SimplifiedInvoice, InvoiceData::class],
    ['invoices', InvoicesEndpoint::UPDATE, EntityTypeEnum::InvoiceReceipt, InvoiceData::class],
    ['invoices', InvoicesEndpoint::UPDATE, EntityTypeEnum::CreditNote, InvoiceData::class],
    ['invoices', InvoicesEndpoint::UPDATE, EntityTypeEnum::DebitNote, InvoiceData::class],
]);

it('can call one-arg UPDATE on an endpoint - faked', function (string $entity, string $action, EntityTypeEnum $type, string $entityDataClass) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $requestSample = getRequestSample(class_basename($endpoint), $action);
    $id = $requestSample['id'];
    $urlParams = ['id' => $id, 'type' => $type?->toUrlVariable()];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response(),
        ]);

    $data = $entityDataClass::from($requestSample);

    expect($endpoint->update($data))
        ->not()->toThrow(Exception::class)
        ->and($endpoint->getResponseCode() === 200);
})->with([
    ['items', ItemsEndpoint::UPDATE, EntityTypeEnum::Item, ItemData::class],
    ['clients', ClientsEndpoint::UPDATE, EntityTypeEnum::Client, ClientData::class],
    ['taxes', TaxesEndpoint::UPDATE, EntityTypeEnum::Tax, TaxData::class],
]);
