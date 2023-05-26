<?php

use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Data\PartialPaymentData;
use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\API\Enums\DocumentStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\InvoiceTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\ItemUnitEnum;
use Squarebit\InvoiceXpress\API\Enums\StateEnum;
use Squarebit\InvoiceXpress\API\IXCreditNoteEndpoint;
use Squarebit\InvoiceXpress\API\IXDebitNoteEndpoint;
use Squarebit\InvoiceXpress\API\IXInvoiceEndpoint;
use Squarebit\InvoiceXpress\API\IXInvoiceReceiptEndpoint;
use Squarebit\InvoiceXpress\API\IXSimplifiedInvoiceEndpoint;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can create / update / delete an invoice', function (IXInvoiceEndpoint $endpoint, array $data) {
    // create the invoice
    /** @var InvoiceData $invoiceData */
    $invoiceData = $endpoint->create(DocumentTypeEnum::Invoice, DocumentTypeEnum::Invoice);

    // get it
    /** @var InvoiceData $invoice */
    $invoice = $endpoint->get($invoiceData->id);
    expect($invoice->toArray())
        ->toMatchArrayRecursive($invoiceData->toArray());

    // update it
    $modified = $invoice->observations = fake()->text(128);
    $endpoint->update($invoice->id, $invoice);

    // confirm it was updated
    /** @var InvoiceData $invoice */
    $invoice = $endpoint->get($invoice->id);
    expect($invoice->observations)
        ->toEqual($modified);
})->with([
    'Invoice' => [(new IXInvoiceEndpoint())],
    'SimplifiedInvoice' => [(new IXSimplifiedInvoiceEndpoint())],
    'InvoiceReceipt' => [(new IXInvoiceReceiptEndpoint())],
    'CreditNote' => [(new IXCreditNoteEndpoint())],
    'DebitNote' => [(new IXDebitNoteEndpoint())],
])->with('invoiceData');

it('can go through an invoice lifecycle', function (array $data) {
    $endpoint = InvoiceXpress::invoice();
    $invoice = $endpoint->create(DocumentTypeEnum::Invoice, DocumentTypeEnum::Invoice);
    $pay = random_int(1, 5);

    /*
     * Finalize the invoice
     */
    expect($invoice = $endpoint->changeState($invoice->id, StateData::from(['state' => StateEnum::Finalized])))
        ->not()->toThrow(Exception::class)
        ->toHaveKey('type', InvoiceTypeEnum::Invoice->value)
        ->toHaveKey('status', DocumentStatusEnum::Final->value)
        // Generate a partial Payment
        ->and($receipt = $endpoint->generatePayment($invoice->id, PartialPaymentData::from(['amount' => $pay])))
        ->toHaveKey('type', InvoiceTypeEnum::Receipt->value)
        ->toHaveKey('total', $pay)
        /*
         * Cancel that partial payment (fails)
         */
        ->and(fn () => $endpoint->cancelPayment($receipt->id, StateData::from(['state' => StateEnum::Canceled])))
        ->toThrow(Exception::class)
        /*
         * Cancel that partial payment (succeeds)
         */
        ->and($receipt = $endpoint->cancelPayment(
            $receipt->id,
            StateData::from([
                'state' => StateEnum::Canceled,
                'message' => fake()->text(),
            ])))
        ->toHaveProperty('status', DocumentStatusEnum::Canceled->value)
        /*
         * Retrieve related documents (should be exactly 1)
         */
        ->and($documentsList = $endpoint->getRelatedDocuments($invoice->id))
        ->toBeInstanceOf(EntityListData::class)
        ->and($documentsList->items())
        ->toHaveCount(1)
        /*
         * Check if it is the receipt previously created (generating a payment automatically creates a receipt)
         */
        ->and($documentsList->items()->first())
        ->toHaveProperty('id', $receipt->id);
})->with('invoiceData');

/*
 * DATASETS
 */
dataset(
    'invoiceData',
    [
        [
            [
                'date' => now(),
                'dueDate' => now()->addDays(random_int(10, 30)),
                'reference' => fake()->colorName,
                'observations' => fake()->text(128),
                'client' => [
                    'name' => 'Some Client Name',
                    'code' => 'A1',
                    'email' => 'foo@bar.com',
                    'address' => 'Saldanha',
                    'city' => 'Lisbon',
                    'postal_code' => '1050-555',
                    'country' => 'Portugal',
                    'fiscal_id' => '999999990',
                    'website' => 'www.website.com',
                    'phone' => '910000000',
                    'fax' => '210000000',
                    'observations' => 'Observations',
                ],
                'items' => [
                    [
                        'name' => 'Some Item Name',
                        'description' => fake()->text(),
                        'unit_price' => random_int(10, 200),
                        'quantity' => random_int(1, 5),
                        'unit' => collect(ItemUnitEnum::values())->random(),
                        'discount' => collect([5, 10, 15, 20, 50])->random(),
                        'tax' => [
                            'name' => 'IVA23',
                        ],
                    ],
                ],
            ],
        ],
    ]
);
