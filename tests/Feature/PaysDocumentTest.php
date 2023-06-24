<?php

use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\API\Endpoints\InvoicesEndpoint;
use Squarebit\InvoiceXpress\Concerns\PaysDocument;
use Squarebit\InvoiceXpress\Models\IxInvoice;
use Squarebit\InvoiceXpress\Models\IxReceipt;
use Squarebit\InvoiceXpress\Models\IxSimplifiedInvoice;

it('pays the simplified invoice', function (string $model) {

    /** @var PaysDocument $instance */
    $payable = new $model();
    $payable->id = random_int(1, 1000);
    $payable->total = 123.45;

    Http::fake(fn () => Http::response(getResponseSample('InvoicesEndpoint', InvoicesEndpoint::GENERATE_PAYMENT)));

    expect($payable->pay())
        ->toBeInstanceOf(IxReceipt::class);

})->with([
    'IxInvoice' => [IxInvoice::class],
    'IxSimpifiedInvoice' => [IxSimplifiedInvoice::class],
]);
