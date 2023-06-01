<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Data\PartialPaymentData;
use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call GENERATE_PAYMENT on an endpoint - faked', function (string $entity, string $action, ?EntityTypeEnum $type, string $entityDataClass) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $requestSample = getRequestSample(class_basename($endpoint), $action);
    $responseSample = getResponseSample(class_basename($endpoint), $action);
    $id = $responseSample[array_keys($responseSample)[0]]['id'];
    $urlParams = ['id' => $id, 'type' => $type?->toUrlVariable()];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response($responseSample),
        ]);

    $data = PartialPaymentData::from($requestSample);

    expect($result = $endpoint->generatePayment($type, $id, $data))
        ->not()->toThrow(Exception::class)
        ->and($result->toArray())
        ->toMatchArrayRecursive($responseSample[array_keys($responseSample)[0]]);
})->with([
    ['invoices', InvoicesEndpoint::GENERATE_PAYMENT, EntityTypeEnum::Invoice, InvoiceData::class],
    ['invoices', InvoicesEndpoint::GENERATE_PAYMENT, EntityTypeEnum::SimplifiedInvoice, InvoiceData::class],
]);

it('can call CANCEL_PAYMENT on an endpoint - faked', function (string $entity, string $action, ?EntityTypeEnum $type, string $entityDataClass) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $requestSample = getRequestSample(class_basename($endpoint), $action);
    $responseSample = getResponseSample(class_basename($endpoint), $action);
    $id = $responseSample[array_keys($responseSample)[0]]['id'];
    $urlParams = ['id' => $id, 'type' => $type?->toUrlVariable()];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response($responseSample),
        ]);

    $data = StateData::from($requestSample);

    expect($result = $endpoint->cancelPayment($type, $id, $data))
        ->not()->toThrow(Exception::class)
        ->and($result->toArray())
        ->toMatchArrayRecursive($responseSample[array_keys($responseSample)[0]]);
})->with([
    ['invoices', InvoicesEndpoint::CANCEL_PAYMENT, EntityTypeEnum::Invoice, InvoiceData::class],
    ['invoices', InvoicesEndpoint::CANCEL_PAYMENT, EntityTypeEnum::SimplifiedInvoice, InvoiceData::class],
]);

it('cannot call GENERATE_PAYMENT on an invalid endpoint - faked', function (string $entity, string $action, ?EntityTypeEnum $type, string $entityDataClass) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $requestSample = getRequestSample(class_basename($endpoint), $action);
    $responseSample = getResponseSample(class_basename($endpoint), $action);
    $id = $responseSample[array_keys($responseSample)[0]]['id'];
    $urlParams = ['id' => $id, 'type' => $type?->toUrlVariable()];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response($responseSample),
        ]);

    $data = PartialPaymentData::from($requestSample);

    expect(fn () => $endpoint->generatePayment($type, $id, $data))
        ->toThrow(UnknownAPIMethodException::class);
})->with([
    ['invoices', InvoicesEndpoint::GENERATE_PAYMENT, EntityTypeEnum::InvoiceReceipt, InvoiceData::class],
    ['invoices', InvoicesEndpoint::GENERATE_PAYMENT, EntityTypeEnum::CreditNote, InvoiceData::class],
    ['invoices', InvoicesEndpoint::GENERATE_PAYMENT, EntityTypeEnum::DebitNote, InvoiceData::class],
]);

it('cannot call CANCEL_PAYMENT on an invalid endpoint - faked', function (string $entity, string $action, ?EntityTypeEnum $type, string $entityDataClass) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $requestSample = getRequestSample(class_basename($endpoint), $action);
    $responseSample = getResponseSample(class_basename($endpoint), $action);
    $id = $responseSample[array_keys($responseSample)[0]]['id'];
    $urlParams = ['id' => $id, 'type' => $type?->toUrlVariable()];

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), $urlParams) => Http::response($responseSample),
        ]);

    $data = StateData::from($requestSample);

    expect(fn () => $endpoint->cancelPayment($type, $id, $data))
        ->toThrow(UnknownAPIMethodException::class);
})->with([
    ['invoices', InvoicesEndpoint::CANCEL_PAYMENT, EntityTypeEnum::InvoiceReceipt, InvoiceData::class],
    ['invoices', InvoicesEndpoint::CANCEL_PAYMENT, EntityTypeEnum::CreditNote, InvoiceData::class],
    ['invoices', InvoicesEndpoint::CANCEL_PAYMENT, EntityTypeEnum::DebitNote, InvoiceData::class],
]);
