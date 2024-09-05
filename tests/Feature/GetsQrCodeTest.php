<?php

use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\Concerns\GetsPdfDocument;
use Squarebit\InvoiceXpress\Database\Factories\IxClientFactory;
use Squarebit\InvoiceXpress\Models\IxDevolution;
use Squarebit\InvoiceXpress\Models\IxInvoice;
use Squarebit\InvoiceXpress\Models\IxInvoiceReceipt;
use Squarebit\InvoiceXpress\Models\IxShipping;
use Squarebit\InvoiceXpress\Models\IxSimplifiedInvoice;
use Squarebit\InvoiceXpress\Models\IxTransport;

it('gets qr code', function (string $model) {
    /** @var GetsPdfDocument $instance */
    $instance = new $model;
    $instance->id = random_int(1, 1000);

    $instance->setClient(IxClientFactory::new()->make());

    $sample = getResponseSample(class_basename($instance->getEndpoint()), $instance->getEndpoint()::GET_QRCODE);
    Http::fake([
        '*' => Http::response($sample),
    ]);
    expect(fn () => $instance->getQrCode())
        ->not()->toThrow(Exception::class);

})->with([
    'Ix' => [IxShipping::class],
    'IxTransport' => [IxTransport::class],
    'IxDevolution' => [IxDevolution::class],
    'IxInvoice' => [IxInvoice::class],
    'IxSimplifiedInvoice' => [IxSimplifiedInvoice::class],
    'IxInvoiceReceipt' => [IxInvoiceReceipt::class],
]);
