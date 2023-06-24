<?php

use GuzzleHttp\UriTemplate\UriTemplate;
use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\DateIntervalFilter;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\NumberIntervalFilter;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\PaginationFilter;
use Squarebit\InvoiceXpress\API\Data\Filters\ClientListFilter;
use Squarebit\InvoiceXpress\API\Data\Filters\EstimateListFilter;
use Squarebit\InvoiceXpress\API\Data\Filters\GuideListFilter;
use Squarebit\InvoiceXpress\API\Data\Filters\InvoiceListFilter;
use Squarebit\InvoiceXpress\API\Data\Filters\ItemListFilter;
use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\Endpoint;
use Squarebit\InvoiceXpress\API\Endpoints\EstimatesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\GuidesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\SequencesEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\TaxesEndpoint;
use Squarebit\InvoiceXpress\Enums\InvoiceStatusEnum;
use Squarebit\InvoiceXpress\Enums\InvoiceTypeEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can call LIST on an endpoint - faked', function (string $entity, string $action, ?string $filter) {
    /** @var Endpoint $endpoint */
    $endpoint = InvoiceXpress::$entity();
    $cfg = $endpoint->getEndpointConfig($action);

    $responseSample = getResponseSample(class_basename($endpoint), $action);

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl(), []).'*' => Http::response($responseSample),
        ]);

    expect($data = $endpoint->list($filter ? $filter::from(['per_page' => 1]) : null))
        ->not()->toThrow(Exception::class)
        ->toBeInstanceOf(EntityListData::class)
        ->and($data->items()->toArray())
        ->toMatchArrayRecursive($responseSample[$entity]);
})->with([
    ['items', ItemsEndpoint::LIST, ItemListFilter::class],
    ['clients', ClientsEndpoint::LIST, ClientListFilter::class],
    ['taxes', TaxesEndpoint::LIST, null],
    ['estimates', EstimatesEndpoint::LIST, EstimateListFilter::class],
    ['guides', GuidesEndpoint::LIST, GuideListFilter::class],
    ['invoices', InvoicesEndpoint::LIST, InvoiceListFilter::class],
    ['sequences', SequencesEndpoint::LIST, null],
]);

it('can call LIST Invoice with Filer - faked', function () {
    $endpoint = InvoiceXpress::invoices();
    $cfg = $endpoint->getEndpointConfig(InvoicesEndpoint::LIST);

    $responseSample = getResponseSample(class_basename($endpoint), InvoicesEndpoint::LIST);

    Http::preventStrayRequests()
        ->fake([
            UriTemplate::expand($cfg->getUrl().'*', []) => Http::response($responseSample),
        ]);

    $filter = InvoiceListFilter::from([
        'text' => fake()->text(),
        'type' => [InvoiceTypeEnum::Receipt, InvoiceTypeEnum::InvoiceReceipt],
        'status' => [InvoiceStatusEnum::Sent, InvoiceStatusEnum::Draft],
        'date' => DateIntervalFilter::from([
            'from' => now()->subDay(),
            'to' => now(),
        ]),
        'dueDate' => DateIntervalFilter::from([
            'from' => now()->subDay(),
            'to' => now(),
        ]),
        'totalBeforeTaxes' => NumberIntervalFilter::from([
            'from' => 10,
            'to' => 15.4,
        ]),
        'nonArchived' => true,
        'archived' => false,
        'reference' => fake()->text(16),
        'pagination' => PaginationFilter::from([
            'page' => 2,
            'per_page' => 30,
        ]),
    ]);

    expect($data = $endpoint->list($filter))
        ->not()->toThrow(Exception::class)
        ->toBeInstanceOf(EntityListData::class)
        ->and($data->items()->toArray())
        ->toMatchArrayRecursive($responseSample['invoices']);
});
