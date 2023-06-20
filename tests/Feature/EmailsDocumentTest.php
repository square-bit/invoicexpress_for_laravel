<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

use Illuminate\Support\Facades\Http;
use Squarebit\InvoiceXpress\Concerns\EmailsDocument;
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
use Squarebit\InvoiceXpress\Models\IxVatMossCreditNote;
use Squarebit\InvoiceXpress\Models\IxVatMossInvoice;
use Squarebit\InvoiceXpress\Models\IxVatMossReceipt;

beforeEach(fn () => Http::fake());

it('sends document via email', function (string $model) {

    /** @var EmailsDocument $instance */
    $instance = new $model();
    $instance->id = random_int(1, 1000);

    $instance->setClient(IxClientFactory::new()->make());

    expect(fn () => $instance->email())
        ->not()->toThrow(Exception::class);

})->with([
    'IxInvoice' => [IxInvoice::class],
    'IxSimpifiedInvoice' => [IxSimplifiedInvoice::class],
    'IxInvoiceReceipt' => [IxInvoiceReceipt::class],
    'IxReceipt' => [IxReceipt::class],
    'IxCreditNote' => [IxCreditNote::class],
    'IxDebitNote' => [IxDebitNote::class],
    'IxVatMossCreditNote' => [IxVatMossCreditNote::class],
    'IxVatMossInvoice' => [IxVatMossInvoice::class],
    'IxVatMossReceipt' => [IxVatMossReceipt::class],
    'IxShipping' => [IxShipping::class],
    'IxTransport' => [IxTransport::class],
    'IxDevolution' => [IxDevolution::class],
    'IxQuote' => [IxQuote::class],
    'IxFeesNote' => [IxFeesNote::class],
    'IxProforma' => [IxProforma::class],
]);
