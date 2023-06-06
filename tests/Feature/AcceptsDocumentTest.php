<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\Concerns\AcceptsDocument;
use Squarebit\InvoiceXpress\Models\IxClient;
use Squarebit\InvoiceXpress\Models\IxFeesNote;
use Squarebit\InvoiceXpress\Models\IxProforma;
use Squarebit\InvoiceXpress\Models\IxQuote;

it('accepts document', function (string $model) {
    /** @var AcceptsDocument $instance */
    $instance = new $model();
    $instance->id = random_int(1, 1000);

    $client = new IxClient();
    $client->email = fake()->email;

    $instance->client = $client;

    Http::fake([
        '*' => Http::response(getResponseSample(
            class_basename($instance->getEndpoint()),
            $instance->getEndpoint()::CHANGE_STATE,
            $instance->getEntityType()
        )),
    ]);
    expect(fn () => $instance->acceptDocument())
        ->not()->toThrow(Exception::class);

})->with([
    'IxQuote' => [IxQuote::class],
    'IxFeesNote' => [IxFeesNote::class],
    'IxProforma' => [IxProforma::class],
]);
