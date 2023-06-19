<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;
use Squarebit\InvoiceXpress\Models\IxClient;
use Squarebit\InvoiceXpress\Models\IxCreditNote;
use Squarebit\InvoiceXpress\Models\IxDebitNote;
use Squarebit\InvoiceXpress\Models\IxFeesNote;
use Squarebit\InvoiceXpress\Models\IxInvoice;
use Squarebit\InvoiceXpress\Models\IxInvoiceReceipt;
use Squarebit\InvoiceXpress\Models\IxItem;
use Squarebit\InvoiceXpress\Models\IxModel;
use Squarebit\InvoiceXpress\Models\IxProforma;
use Squarebit\InvoiceXpress\Models\IxQuote;
use Squarebit\InvoiceXpress\Models\IxShipping;
use Squarebit\InvoiceXpress\Models\IxSimplifiedInvoice;
use Squarebit\InvoiceXpress\Models\IxTax;
use Squarebit\InvoiceXpress\Models\IxTransport;

dataset('find_create_update_models', [
    'Item' => [IxItem::class, 'description'],
    'Client' => [IxClient::class, 'observations'],
    'Tax' => [IxTax::class, 'name'],
    'Invoice - Invoice' => [IxInvoice::class, 'observations'],
    'Invoice - Simplified invoice' => [IxSimplifiedInvoice::class, 'reference'],
    'Invoice - Invoice receipt' => [IxInvoiceReceipt::class, 'reference'],
    'Invoice - Debit note' => [IxDebitNote::class, 'reference'],
    'Invoice - Credit note' => [IxCreditNote::class, 'reference'],
    'Estimate - Quote' => [IxQuote::class, 'observations'],
    'Estimate - Proforma' => [IxProforma::class, 'reference'],
    'Estimate - Fees note' => [IxFeesNote::class, 'reference'],
    'Guide - Shipping' => [IxShipping::class, 'observations'],
    'Guide - Transport' => [IxTransport::class, 'reference'],
    'Guide - Devolution' => [IxDebitNote::class, 'reference'],
]);

dataset('delete_models', [
    'Item' => [IxItem::class, ItemsEndpoint::class, 'description'],
]);

dataset('non_deletable_models', [
    'Client' => [IxClient::class, ClientsEndpoint::class, 'observations'],
]);

it('will fail to find a nonexistent IxModel', function (string $model) {
    $id = random_int(1, 10000);
    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}.json?*" => Http::response(null, 404),
    ]);

    // fail to find the item since we'll get a 404
    expect($model::find($id))->toBeNull()
        ->and($model::count())->toBe(0);

})->with('find_create_update_models');

it('can create an IxModel', function (bool $persistLocally, string $model) {

    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);

    /** @var IxModel $instance */
    $instance = (new $model());
    $endpoint = $instance->getEndpoint();
    $type = $instance->getEntityType();

    $requestSample = getRequestSample(class_basename($endpoint), $endpoint::CREATE);
    $responseSample = getResponseSample(class_basename($endpoint), $endpoint::CREATE, $type);

    $instance = (new $model())
        ->fromData($requestSample);

    Http::fake([
        'https://*.app.invoicexpress.com/*.json?*' => Http::response($responseSample),
    ]);
    expect($instance->save())->toBeTrue()
        ->and($instance->exists)->toBe($persistLocally)
        ->and($instance->toArray())->toMatchArrayRecursive(reset($responseSample))
        ->and($model::withoutGlobalScopes()->count())->toBe($persistLocally ? 1 : 0);

})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
])->with('find_create_update_models');

it('can find an IxModel', function (bool $persistLocally, string $model) {

    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);

    /** @var IxModel $instance */
    $instance = (new $model());
    $endpoint = $instance->getEndpoint();
    $type = $instance->getEntityType();
    $responseSample = getResponseSample(class_basename($endpoint), $endpoint::GET, $type);
    $id = reset($responseSample)['id'];

    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}.json?*" => Http::response($responseSample),
    ]);

    expect($instance = $model::find($id))->toBeInstanceOf($model)
        ->and($instance->exists)->toBe($persistLocally)
        ->and($instance->toArray())->toMatchArrayRecursive(reset($responseSample))
        ->and($model::count())->toBe($persistLocally ? 1 : 0);

})->with([
    'persist locally' => [true],
    //    "don't persist locally" => [false],
])->with('find_create_update_models');

it('can update an IxModel', function (bool $persistLocally, string $model, string $toModify) {

    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);

    /** @var IxModel $instance */
    $instance = (new $model());
    $endpoint = $instance->getEndpoint();
    $type = $instance->getEntityType();
    $requestSample = getRequestSample(class_basename($endpoint), $endpoint::UPDATE);
    $GETResponseSample = getResponseSample(class_basename($endpoint), $endpoint::GET, $type);
    $id = $requestSample['id'];

    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}.json?*" => Http::response($GETResponseSample),
    ]);

    expect($instance = $model::find($id))->toBeInstanceOf($model);

    $modified = $instance->$toModify = fake()->text();

    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}.json?*" => Http::response(),
    ]);

    expect($instance->save())->toBeTrue()
        ->and($instance->exists)->toBe($persistLocally)
        ->and($instance->$toModify)->toBe($modified)
        ->when($persistLocally, fn ($instance) => expect($model::find($id))->$toModify->toBe($modified));

})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
])->with('find_create_update_models')
    ->depends('it can create an IxModel');

it('can fail to update an IxModel', function (bool $persistLocally, string $model) {

    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);

    /** @var IxModel $instance */
    $instance = (new $model());
    $endpoint = $instance->getEndpoint();
    $type = $instance->getEntityType();
    $requestSample = getRequestSample(class_basename($endpoint), $endpoint::UPDATE);
    $GETResponseSample = getResponseSample(class_basename($endpoint), $endpoint::GET, $type);
    $id = $requestSample['id'];

    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}.json?*" => Http::sequence()
            ->push($GETResponseSample)
            ->whenEmpty(Http::response(null, 404)),
    ]);

    $instance = $model::find($id);
    expect($instance)->toBeInstanceOf($model);

    expect($instance->save())->toBeFalse();

})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
])->with('find_create_update_models')
    ->depends('it can create an IxModel');

it('can refresh an IxModel from API', function (bool $persistLocally, string $model, string $toModify) {

    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);
    /** @var IxModel $instance */
    $instance = (new $model());
    $endpoint = $instance->getEndpoint();
    $type = $instance->getEntityType();
    $requestSample = getRequestSample(class_basename($endpoint), $endpoint::UPDATE);
    $GETResponseSample = getResponseSample(class_basename($endpoint), $endpoint::GET, $type);
    $id = $requestSample['id'];

    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}.json?*" => Http::response($GETResponseSample),
    ]);

    expect($instance = $model::find($id))->toBeInstanceOf($model);

    $modified = $instance->$toModify = fake()->text();

    expect($instance->refreshFromRemote())->toBeInstanceOf($instance::class)
        ->and($instance->exists)->toBe($persistLocally)
        ->and($instance->$toModify)->not()->toBe($modified);

})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
])->with('find_create_update_models')
    ->depends('it can create an IxModel');

it('can delete an IxModel', function (bool $persistLocally, string $model) {
    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);
    /** @var IxModel $instance */
    $instance = (new $model());
    $endpoint = $instance->getEndpoint();
    $type = $instance->getEntityType();
    $GETresponseSample = getResponseSample(class_basename($endpoint), $endpoint::GET, $type);
    $id = reset($GETresponseSample)['id'];
    Http::fake([
        'https://*.app.invoicexpress.com/*.json?*' => Http::response(),
    ]);

    $instance = (new $model())
        ->fromData(reset($GETresponseSample));
    $instance->save();

    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}.json?*" => Http::response(),
    ]);

    expect($instance)->exists->toBe($persistLocally)
        ->and($instance->delete())->toBeTrue()
        ->and($instance->exists)->toBe(false)
        ->and($model::count())->toBe(0);
})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
])->with('delete_models');

it('cannot delete an IxModel without an id', function (bool $persistLocally, string $model) {
    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);
    $endpoint = (new $model())->getEndpoint();
    $createSample = getRequestSample(class_basename($endpoint), $endpoint::CREATE);

    $instance = (new $model())
        ->fromData($createSample);

    expect($instance)->exists->toBeFalse()
        ->and($instance->delete())->toBeFalse();
})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
])->with('delete_models');

it('cannot delete an IxModel if API does not support it', function (bool $persistLocally, string $model) {
    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);
    /** @var IxModel $instance */
    $instance = (new $model());
    $endpoint = $instance->getEndpoint();
    $type = $instance->getEntityType();
    $GETresponseSample = getResponseSample(class_basename($endpoint), $endpoint::GET, $type);
    $id = reset($GETresponseSample)['id'];
    Http::fake([
        'https://*.app.invoicexpress.com/*.json?*' => Http::response(),
    ]);

    $instance = (new $model())
        ->fromData(reset($GETresponseSample));
    $instance->save();

    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}.json?*" => Http::response(),
    ]);

    expect(fn () => $instance->delete())
        ->toThrow(UnknownAPIMethodException::class);
})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
])->with('non_deletable_models');

it('cannot accept data of a different class', function (string $model) {
    $data = ItemData::from(['name' => fake()->name, 'unit_price' => random_int(1, 10), 'tax' => ['name' => 'IVA23']]);

    expect(fn () => (new $model())->fromData($data))
        ->toThrow(InvalidArgumentException::class);
})->with([
    'IxInvoice' => [IxInvoice::class],
    'IxSimplifiedInvoice' => [IxSimplifiedInvoice::class],
    'IxShipping' => [IxShipping::class],
]);
