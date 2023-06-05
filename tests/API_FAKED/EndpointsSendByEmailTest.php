<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Data\EmailData;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call SEND_BY_EMAIL on an endpoint - faked', function (string $entity, string $action, EntityTypeEnum $type) {
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
    ['estimates', EstimatesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::Quote],
    ['estimates', EstimatesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::Proforma],
    ['estimates', EstimatesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::FeesNote],
    ['guides', GuidesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::Shipping],
    ['guides', GuidesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::Transport],
    ['guides', GuidesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::Devolution],
    ['invoices', InvoicesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::Invoice],
    ['invoices', InvoicesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::SimplifiedInvoice],
    ['invoices', InvoicesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::InvoiceReceipt],
    ['invoices', InvoicesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::CreditNote],
    ['invoices', InvoicesEndpoint::SEND_BY_EMAIL, EntityTypeEnum::DebitNote],
]);
