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

it('can call GET on an endpoint - faked', function (string $entity, string $action, ?EntityTypeEnum $type, string $entityDataClass) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $responseSample = getResponseSample(class_basename($endpoint), $action.($type ? '-'.$type->value : ''));
    $id = $responseSample[array_keys($responseSample)[0]]['id'];
    $urlParams = ['id' => $id, 'type' => $type?->toUrlVariable()];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response($responseSample),
        ]);

    expect($result = $endpoint->get($type ?: $id, $type ? $id : null))
        ->not()->toThrow(Exception::class)
        ->toBeInstanceOf($entityDataClass)
        ->when($type !== null, fn ($result) => $result->type->toEntityType()->toBe($type))
        ->and($result->toArray())
        ->toMatchArrayRecursive($responseSample[array_keys($responseSample)[0]]);
})->with([
    ['items', ItemsEndpoint::GET, null, ItemData::class],
    ['clients', ClientsEndpoint::GET, null, ClientData::class],
    ['taxes', TaxesEndpoint::GET, null, TaxData::class],
    ['estimates', EstimatesEndpoint::GET, EntityTypeEnum::Quote, EstimateData::class],
    ['estimates', EstimatesEndpoint::GET, EntityTypeEnum::Proforma, EstimateData::class],
    ['estimates', EstimatesEndpoint::GET, EntityTypeEnum::FeesNote, EstimateData::class],
    ['guides', GuidesEndpoint::GET, EntityTypeEnum::Shipping, GuideData::class],
    ['guides', GuidesEndpoint::GET, EntityTypeEnum::Transport, GuideData::class],
    ['guides', GuidesEndpoint::GET, EntityTypeEnum::Devolution, GuideData::class],
    ['invoices', InvoicesEndpoint::GET, EntityTypeEnum::Invoice, InvoiceData::class],
    ['invoices', InvoicesEndpoint::GET, EntityTypeEnum::SimplifiedInvoice, InvoiceData::class],
    ['invoices', InvoicesEndpoint::GET, EntityTypeEnum::InvoiceReceipt, InvoiceData::class],
    ['invoices', InvoicesEndpoint::GET, EntityTypeEnum::CreditNote, InvoiceData::class],
    ['invoices', InvoicesEndpoint::GET, EntityTypeEnum::DebitNote, InvoiceData::class],
    ['sequences', SequencesEndpoint::GET, null, SequenceData::class],
]);
