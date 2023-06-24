<?php

use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\Concerns\DeletesDocument;
use Squarebit\InvoiceXpress\Database\Factories\IxClientFactory;
use Squarebit\InvoiceXpress\Models\IxCreditNote;
use Squarebit\InvoiceXpress\Models\IxDebitNote;
use Squarebit\InvoiceXpress\Models\IxDevolution;
use Squarebit\InvoiceXpress\Models\IxFeesNote;
use Squarebit\InvoiceXpress\Models\IxInvoice;
use Squarebit\InvoiceXpress\Models\IxInvoiceReceipt;
use Squarebit\InvoiceXpress\Models\IxProforma;
use Squarebit\InvoiceXpress\Models\IxQuote;
use Squarebit\InvoiceXpress\Models\IxReceipt;
use Squarebit\InvoiceXpress\Models\IxShipping;
use Squarebit\InvoiceXpress\Models\IxSimplifiedInvoice;
use Squarebit\InvoiceXpress\Models\IxTransport;

it('deletes document', function (string $model) {
    /** @var DeletesDocument $instance */
    $instance = new $model();
    $instance->id = random_int(1, 1000);

    $instance->setClient(IxClientFactory::new()->make());

    Http::fake([
        '*' => Http::response(getResponseSample(
            class_basename($instance->getEndpoint()),
            $instance->getEndpoint()::CHANGE_STATE,
            $instance->getEntityType()
        )),
    ]);
    expect(fn () => $instance->deleteDocument())
        ->not()->toThrow(Exception::class);

})->with([
    'IxInvoice' => [IxInvoice::class],
    'IxSimpifiedInvoice' => [IxSimplifiedInvoice::class],
    'IxInvoiceReceipt' => [IxInvoiceReceipt::class],
    'IxReceipt' => [IxReceipt::class],
    'IxCreditNote' => [IxCreditNote::class],
    'IxDebitNote' => [IxDebitNote::class],
    'IxShipping' => [IxShipping::class],
    'IxTransport' => [IxTransport::class],
    'IxDevolution' => [IxDevolution::class],
    'IxQuote' => [IxQuote::class],
    'IxFeesNote' => [IxFeesNote::class],
    'IxProforma' => [IxProforma::class],
]);
