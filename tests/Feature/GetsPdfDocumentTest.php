<?php

use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\Concerns\GetsPdfDocument;
use Squarebit\InvoiceXpress\Database\Factories\IxClientFactory;
use Squarebit\InvoiceXpress\Models\IxFeesNote;
use Squarebit\InvoiceXpress\Models\IxProforma;
use Squarebit\InvoiceXpress\Models\IxQuote;

it('gets pdf document', function (string $model) {
    /** @var GetsPdfDocument $instance */
    $instance = new $model();
    $instance->id = random_int(1, 1000);

    $instance->setClient(IxClientFactory::new()->make());

    $sample = getResponseSample(class_basename($instance->getEndpoint()), $instance->getEndpoint()::GENERATE_PDF);
    Http::fake([
        '*' => Http::sequence([
            Http::response(null, 202),
            Http::response($sample),
        ]),
    ]);
    expect(fn () => $instance->getPdf())
        ->not()->toThrow(Exception::class);

})->with([
    'IxQuote' => [IxQuote::class],
    'IxFeesNote' => [IxFeesNote::class],
    'IxProforma' => [IxProforma::class],
]);

it('fails to get pdf document', function (string $model) {
    /** @var GetsPdfDocument $instance */
    $instance = new $model();
    $instance->id = random_int(1, 1000);

    $instance->setClient(IxClientFactory::new()->make());

    $instance->setGetPdfMaxRetries(random_int(1, 3));
    $sample = getResponseSample(class_basename($instance->getEndpoint()), $instance->getEndpoint()::GENERATE_PDF);
    Http::fake([
        '*' => Http::sequence(array_fill(0, $instance->getGetPdfMaxRetries(), Http::response(null, 202))),
    ]);

    expect($pdfData = $instance->getPdf())
        ->toBeNull();

})->with([
    'IxQuote' => [IxQuote::class],
    'IxFeesNote' => [IxFeesNote::class],
    'IxProforma' => [IxProforma::class],
]);
