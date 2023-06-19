<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\Concerns\UnsettlesDocument;
use Squarebit\InvoiceXpress\Database\Factories\IxClientFactory;
use Squarebit\InvoiceXpress\Models\IxCreditNote;
use Squarebit\InvoiceXpress\Models\IxDebitNote;

it('unsettles document', function (string $model) {
    /** @var UnsettlesDocument $instance */
    $instance = new $model();
    $instance->id = random_int(1, 1000);

    $instance->client = IxClientFactory::new()->make()->getData();

    Http::fake([
        '*' => Http::response(getResponseSample(
            class_basename($instance->getEndpoint()),
            $instance->getEndpoint()::CHANGE_STATE,
            $instance->getEntityType()
        )),
    ]);
    expect(fn () => $instance->unsettleDocument())
        ->not()->toThrow(Exception::class);

})->with([
    'IxCreditNote' => [IxCreditNote::class],
    'IxDebitNote' => [IxDebitNote::class],
]);
