<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Data\EstimateData;
use Squarebit\InvoiceXpress\API\Data\GuideData;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call CHANGE_STATE on an endpoint - faked', function (string $entity, string $action, EntityTypeEnum $type, string $entityDataClass) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $requestSample = getRequestSample(class_basename($endpoint), $action);
    $responseSample = getResponseSample(class_basename($endpoint), $action, $type);
    $id = reset($responseSample)['id'];
    $urlParams = ['id' => $id, 'type' => $type?->toUrlVariable()];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response($responseSample),
        ]);

    $data = StateData::from($requestSample);

    expect($result = $endpoint->changeState($type, $id, $data))
        ->not()->toThrow(Exception::class)
        ->and($result->toArray())
        ->toMatchArrayRecursive(reset($responseSample));
})->with([
    ['estimates', EstimatesEndpoint::CHANGE_STATE, EntityTypeEnum::Quote, EstimateData::class],
    ['estimates', EstimatesEndpoint::CHANGE_STATE, EntityTypeEnum::Proforma, EstimateData::class],
    ['estimates', EstimatesEndpoint::CHANGE_STATE, EntityTypeEnum::FeesNote, EstimateData::class],
    ['guides', GuidesEndpoint::CHANGE_STATE, EntityTypeEnum::Shipping, GuideData::class],
    ['guides', GuidesEndpoint::CHANGE_STATE, EntityTypeEnum::Transport, GuideData::class],
    ['guides', GuidesEndpoint::CHANGE_STATE, EntityTypeEnum::Devolution, GuideData::class],
    ['invoices', InvoicesEndpoint::CHANGE_STATE, EntityTypeEnum::Invoice, InvoiceData::class],
    ['invoices', InvoicesEndpoint::CHANGE_STATE, EntityTypeEnum::SimplifiedInvoice, InvoiceData::class],
    ['invoices', InvoicesEndpoint::CHANGE_STATE, EntityTypeEnum::InvoiceReceipt, InvoiceData::class],
    ['invoices', InvoicesEndpoint::CHANGE_STATE, EntityTypeEnum::CreditNote, InvoiceData::class],
    ['invoices', InvoicesEndpoint::CHANGE_STATE, EntityTypeEnum::DebitNote, InvoiceData::class],
]);
