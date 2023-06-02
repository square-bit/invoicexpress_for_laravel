<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Endpoints\ItemsEndpoint;
use Squarebit\InvoiceXpress\Models\IxItem;

it('will fail to find a nonexistent Item', function () {
    $id = random_int(1, 10000);
    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}.json?*" => Http::response(null, 404),
    ]);

    // fail to find the item since we'll get a 404
    expect(IxItem::find($id))->toBeNull()
        ->and(IxItem::count())->toBe(0);

})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
]);

it('can create an Item', function (bool $persistLocally) {

    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);
    $requestSample = getRequestSample(class_basename(ItemsEndpoint::class), ItemsEndpoint::CREATE);
    $responseSample = getResponseSample(class_basename(ItemsEndpoint::class), ItemsEndpoint::CREATE);

    $item = (new IxItem())
        ->forceFill($requestSample);

    Http::fake([
        'https://*.app.invoicexpress.com/*.json?*' => Http::response($responseSample),
    ]);
    expect($item->save())->toBeTrue()
        ->and($item->exists)->toBe($persistLocally)
        ->and($item->toArray())->toMatchArrayRecursive(reset($responseSample))
        ->and(IxItem::count())->toBe($persistLocally ? 1 : 0);

})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
]);

it('can find an Item', function (bool $persistLocally) {

    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);
    $requestSample = getRequestSample(class_basename(ItemsEndpoint::class), ItemsEndpoint::CREATE);
    $responseSample = getResponseSample(class_basename(ItemsEndpoint::class), ItemsEndpoint::CREATE);
    $id = reset($responseSample)['id'];

    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}.json?*" => Http::response($responseSample),
    ]);

    expect($item = IxItem::find($id))->toBeInstanceOf(IxItem::class)
        ->and($item->exists)->toBe($persistLocally)
        ->and($item->toArray())->toMatchArrayRecursive(reset($responseSample))
        ->and(IxItem::count())->toBe($persistLocally ? 1 : 0);

})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
]);

it('can update an Item', function (bool $persistLocally) {

    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);
    $requestSample = getRequestSample(class_basename(ItemsEndpoint::class), ItemsEndpoint::UPDATE);
    $GETResponseSample = getResponseSample(class_basename(ItemsEndpoint::class), ItemsEndpoint::GET);
    $id = $requestSample['id'];

    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}.json?*" => Http::response($GETResponseSample),
    ]);

    expect($item = IxItem::find($id))->toBeInstanceOf(IxItem::class);

    $modified = $item->description = fake()->text();

    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}.json?*" => Http::response(),
    ]);

    expect($item->save())->toBeTrue()
        ->and($item->exists)->toBe($persistLocally)
        ->and($item->description)->toBe($modified)
        ->when($persistLocally, fn ($item) => expect(IxItem::find($id))->description->toBe($modified));

})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
])->depends('it can create an Item');

it('can delete an Item', function (bool $persistLocally) {

    config(['invoicexpress-for-laravel.eloquent.persist' => $persistLocally]);

    // first we must create it
    $requestSample = getRequestSample(class_basename(ItemsEndpoint::class), ItemsEndpoint::CREATE);
    $responseSample = getResponseSample(class_basename(ItemsEndpoint::class), ItemsEndpoint::CREATE);
    $id = reset($responseSample)['id'];
    Http::fake([
        'https://*.app.invoicexpress.com/*.json?*' => Http::response($responseSample),
    ]);

    $item = (new IxItem())
        ->forceFill($requestSample);
    $item->save();

    Http::fake([
        "https://*.app.invoicexpress.com/*/{$id}.json?*" => Http::response(),
    ]);

    expect($item->delete())->toBeTrue()
        ->and($item->exists)->toBe(false)
        ->and(IxItem::count())->toBe(0);

})->with([
    'persist locally' => [true],
    "don't persist locally" => [false],
]);
