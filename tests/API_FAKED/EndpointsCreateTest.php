<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\API\Data\EstimateData;
use Squarebit\InvoiceXpress\API\Data\GuideData;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Data\SequenceData;
use Squarebit\InvoiceXpress\API\Data\TaxData;
use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\SequencesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\TaxesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call CREATE on an endpoint - faked', function (string $entity, string $action, EntityTypeEnum $type, string $entityDataClass) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $requestSample = getRequestSample(class_basename($endpoint), $action);
    $responseSample = getResponseSample(class_basename($endpoint), $action, $type);
    $urlParams = ['type' => $type?->toUrlVariable()];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response($responseSample),
        ]);

    $data = $entityDataClass::from($requestSample);

    expect($result = $endpoint->create($type, $data))
        ->not()->toThrow(Exception::class)
        ->toBeInstanceOf($entityDataClass)
        ->and($result->toArray())
        ->toMatchArrayRecursive(reset($responseSample));
})->with([
    ['items', ItemsEndpoint::CREATE, EntityTypeEnum::Item, ItemData::class],
    ['clients', ClientsEndpoint::CREATE, EntityTypeEnum::Client, ClientData::class],
    ['taxes', TaxesEndpoint::CREATE, EntityTypeEnum::Tax, TaxData::class],
    ['estimates', EstimatesEndpoint::CREATE, EntityTypeEnum::Quote, EstimateData::class],
    ['estimates', EstimatesEndpoint::CREATE, EntityTypeEnum::Proforma, EstimateData::class],
    ['estimates', EstimatesEndpoint::CREATE, EntityTypeEnum::FeesNote, EstimateData::class],
    ['guides', GuidesEndpoint::CREATE, EntityTypeEnum::Shipping, GuideData::class],
    ['guides', GuidesEndpoint::CREATE, EntityTypeEnum::Transport, GuideData::class],
    ['guides', GuidesEndpoint::CREATE, EntityTypeEnum::Devolution, GuideData::class],
    ['invoices', InvoicesEndpoint::CREATE, EntityTypeEnum::Invoice, InvoiceData::class],
    ['invoices', InvoicesEndpoint::CREATE, EntityTypeEnum::SimplifiedInvoice, InvoiceData::class],
    ['invoices', InvoicesEndpoint::CREATE, EntityTypeEnum::InvoiceReceipt, InvoiceData::class],
    ['invoices', InvoicesEndpoint::CREATE, EntityTypeEnum::CreditNote, InvoiceData::class],
    ['invoices', InvoicesEndpoint::CREATE, EntityTypeEnum::DebitNote, InvoiceData::class],
    ['sequences', SequencesEndpoint::CREATE, EntityTypeEnum::Sequence, SequenceData::class],
]);

it('can call one-arg CREATE on an endpoint - faked', function (string $entity, string $action, EntityTypeEnum $type, string $entityDataClass) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $requestSample = getRequestSample(class_basename($endpoint), $action);
    $responseSample = getResponseSample(class_basename($endpoint), $action, $type);
    $urlParams = ['type' => $type?->toUrlVariable()];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response($responseSample),
        ]);

    $data = $entityDataClass::from($requestSample);

    expect($result = $endpoint->create($data))
        ->not()->toThrow(Exception::class)
        ->toBeInstanceOf($entityDataClass)
        ->and($result->toArray())
        ->toMatchArrayRecursive(reset($responseSample));
})->with([
    ['items', ItemsEndpoint::CREATE, EntityTypeEnum::Item, ItemData::class],
    ['clients', ClientsEndpoint::CREATE, EntityTypeEnum::Client, ClientData::class],
    ['taxes', TaxesEndpoint::CREATE, EntityTypeEnum::Tax, TaxData::class],
]);
