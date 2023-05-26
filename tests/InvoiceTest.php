<?php

use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Data\PartialPaymentData;
use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\API\Enums\InvoiceStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\InvoiceTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\ItemUnitEnum;
use Squarebit\InvoiceXpress\API\Enums\DocumentEventEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can create / update / delete an invoice', function (DocumentTypeEnum $docType, array $data) {
    $endpoint = InvoiceXpress::invoices();
    // create the invoice
    /** @var InvoiceData $invoiceData */
    $invoiceData = InvoiceXpress::invoices()->create($docType, InvoiceData::from($data));

    // get it
    /** @var InvoiceData $invoice */
    $invoice = $endpoint->get($docType, $invoiceData->id);
    expect($invoice->toArray())
        ->toMatchArrayRecursive($invoiceData->toArray());

    // update it
    $modified = $invoice->observations = fake()->text(128);
    $endpoint->update($docType, $invoice->id, $invoice);

    // confirm it was updated
    /** @var InvoiceData $invoice */
    $invoice = $endpoint->get($docType, $invoice->id);
    expect($invoice->observations)
        ->toEqual($modified);
})->with([
    'Invoice' => [DocumentTypeEnum::Invoice],
    'SimplifiedInvoice' => [DocumentTypeEnum::SimplifiedInvoice],
    'InvoiceReceipt' => [DocumentTypeEnum::InvoiceReceipt],
    'CreditNote' => [DocumentTypeEnum::CreditNote],
    'DebitNote' => [DocumentTypeEnum::DebitNote],
])->with('invoiceData');

it('can go through an invoice lifecycle', function (array $data) {
    $endpoint = InvoiceXpress::invoices();
    $docType = DocumentTypeEnum::Invoice;
    $invoice = $endpoint->create($docType, InvoiceData::from($data));
    $pay = random_int(1, 5);

    /*
     * Finalize the invoice
     */
    expect($invoice = $endpoint->changeState(
        DocumentTypeEnum::Invoice,
        $invoice->id,
        StateData::from(['state' => DocumentEventEnum::Finalized]))
    )->not()->toThrow(Exception::class)
        ->toHaveKey('type', InvoiceTypeEnum::Invoice->value)
        ->toHaveKey('status', InvoiceStatusEnum::Final->value)
        // Generate a partial Payment
        ->and($receipt = $endpoint->generatePayment($docType, $invoice->id,
            PartialPaymentData::from(['amount' => $pay])))
        ->toHaveKey('type', InvoiceTypeEnum::Receipt->value)
        ->toHaveKey('total', $pay)
        /*
         * Cancel that partial payment (fails)
         */
        ->and(fn () => $endpoint->cancelPayment(
            $docType,
            $receipt->id,
            StateData::from(['state' => DocumentEventEnum::Canceled]))
        )->toThrow(Exception::class)
        /*
         * Cancel that partial payment (succeeds)
         */
        ->and($receipt = $endpoint->cancelPayment(
            $docType,
            $receipt->id,
            StateData::from([
                'state' => DocumentEventEnum::Canceled,
                'message' => fake()->text(),
            ])))
        ->toHaveProperty('status', InvoiceStatusEnum::Canceled->value)
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
                'due_date' => now()->addDays(random_int(10, 30)),
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
