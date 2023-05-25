<?php

use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Enums\ItemUnitEnum;
use Squarebit\InvoiceXpress\API\IXCreditNoteEndpoint;
use Squarebit\InvoiceXpress\API\IXDebitNoteEndpoint;
use Squarebit\InvoiceXpress\API\IXInvoiceEndpoint;
use Squarebit\InvoiceXpress\API\IXInvoiceReceiptEndpoint;
use Squarebit\InvoiceXpress\API\IXSimplifiedInvoiceEndpoint;

it('can create / update /delete an invoice', function (IXInvoiceEndpoint $endpoint, array $data) {
    // create the invoice
    /** @var InvoiceData $invoice */
    $invoiceData = $endpoint->create(InvoiceData::from($data));

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
])->with([
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
]);
