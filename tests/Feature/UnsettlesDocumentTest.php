<?php

use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\Concerns\UnsettlesDocument;
use Squarebit\InvoiceXpress\Database\Factories\IxClientFactory;
use Squarebit\InvoiceXpress\Models\IxCreditNote;
use Squarebit\InvoiceXpress\Models\IxDebitNote;

it('unsettles document', function (string $model) {
    /** @var UnsettlesDocument $instance */
    $instance = new $model;
    $instance->id = random_int(1, 1000);

    $instance->setClient(IxClientFactory::new()->make());

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
