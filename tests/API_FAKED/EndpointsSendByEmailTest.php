<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Data\EmailData;
use Squarebit\InvoiceXpress\API\Data\EstimateData;
use Squarebit\InvoiceXpress\API\Data\GuideData;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call SEND_BY_EMAIL on an endpoint - faked', function (string $entity, string $action, ?EntityTypeEnum $type, string $entityDataClass) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $requestSample = getRequestSample(class_basename($endpoint), $action);
    $id = random_int(1, 1000);
    $urlParams = ['id' => $id, 'type' => $type?->toUrlVariable()];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response(),
        ]);

    $data = EmailData::from($requestSample);

    expect($result = $endpoint->sendByEmail($type, $id, $data))
        ->not()->toThrow(Exception::class);
})->with([
    ['estimates', EstimatesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::Quote, EstimateData::class],
    ['estimates', EstimatesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::Proforma, EstimateData::class],
    ['estimates', EstimatesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::FeesNote, EstimateData::class],
    ['guides', GuidesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::Shipping, GuideData::class],
    ['guides', GuidesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::Transport, GuideData::class],
    ['guides', GuidesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::Devolution, GuideData::class],
    ['invoices', InvoicesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::Invoice, InvoiceData::class],
    ['invoices', InvoicesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::SimplifiedInvoice, InvoiceData::class],
    ['invoices', InvoicesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::InvoiceReceipt, InvoiceData::class],
    ['invoices', InvoicesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::CreditNote, InvoiceData::class],
    ['invoices', InvoicesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::DebitNote, InvoiceData::class],
]);
