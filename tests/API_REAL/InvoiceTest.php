<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

use GuzzleHttp\Exception\RequestException;
use Squarebit\InvoiceXpress\API\Data\EmailClientData;
use Squarebit\InvoiceXpress\API\Data\EmailData;
use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Data\Filters\InvoiceListFilter;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Data\PartialPaymentData;
use Squarebit\InvoiceXpress\API\Data\PdfData;
use Squarebit\InvoiceXpress\API\Data\QRCodeData;
use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\API\Enums\DocumentEventEnum;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\InvoiceStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\InvoiceTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\ItemUnitEnum;
use Squarebit\InvoiceXpress\API\Enums\PaymentMechanismEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can create / get / list / update / delete an invoice', function (EntityTypeEnum $entityType, array $data) {

    // force a random reference for each "invoice" type
    $data['reference'] = fake()->realText(64);

    $endpoint = InvoiceXpress::invoices();

    // create
    /** @var InvoiceData $invoiceData */
    $invoiceData = InvoiceXpress::invoices()->create($entityType, InvoiceData::from($data));
    expect($invoiceData->type->toEntityType())
        ->toEqual($entityType);

    // get it
    /** @var InvoiceData $invoice */
    $invoice = $endpoint->get($entityType, $invoiceData->id);
    expect($invoice->toArray())
        ->toMatchArrayRecursive($invoiceData->toArray());

    // listing (with filter) a recently created invoice sometimes does not find that invoice
    // Wait for a couple of seconds so the result is as expected...
    sleep(2);
    // list
    expect(InvoiceXpress::invoices()->list())
        ->toBeInstanceOf(EntityListData::class)
        ->items()->count()->toBeGreaterThanOrEqual(1) // we accept greaterThan since the account might have more Clients
        ->and(InvoiceXpress::invoices()->list(InvoiceListFilter::from(['reference' => $invoiceData->reference])))
        ->items()->count()->toBe(1);

    // update it
    $modified = $invoice->observations = fake()->text(128);
    $endpoint->update($entityType, $invoice);

    // confirm it was updated
    /** @var InvoiceData $invoice */
    $invoice = $endpoint->get($entityType, $invoice->id);
    expect($invoice->observations)
        ->toEqual($modified);
})->with([
    'Invoice' => [EntityTypeEnum::Invoice],
    'SimplifiedInvoice' => [EntityTypeEnum::SimplifiedInvoice],
    'InvoiceReceipt' => [EntityTypeEnum::InvoiceReceipt],
    'CreditNote' => [EntityTypeEnum::CreditNote],
    'DebitNote' => [EntityTypeEnum::DebitNote],
])->with('invoiceData');

it('can go through an invoice lifecycle', function (array $data) {
    $endpoint = InvoiceXpress::invoices();
    $docType = EntityTypeEnum::Invoice;

    // Create the Invoice
    $invoice = $endpoint->create($docType, InvoiceData::from($data));
    $pay = $invoice->total;

    // Finalize it
    expect($invoice = $endpoint->changeState(
        EntityTypeEnum::Invoice,
        $invoice->id,
        StateData::from(['state' => DocumentEventEnum::Finalized]))
    )->not()->toThrow(Exception::class)
        ->toHaveKey('type', InvoiceTypeEnum::Invoice->value)
        ->toHaveKey('status', InvoiceStatusEnum::Final->value)

        // Generate a Payment
        ->and($receipt = $endpoint->generatePayment($docType, $invoice->id,
            PartialPaymentData::from(['amount' => $pay, 'paymentMechanism' => PaymentMechanismEnum::CC])))
        ->toHaveKey('type', InvoiceTypeEnum::Receipt->value)
        ->toHaveKey('total', $pay)

        // Cancel that payment: fails because it needs a message/reason for canceling
        ->and(fn () => $endpoint->cancelPayment(
            $docType,
            $receipt->id,
            StateData::from(['state' => DocumentEventEnum::Canceled]))
        )->toThrow(Exception::class)

        // Cancel that payment (succeeds)
        ->and($receipt = $endpoint->cancelPayment(
            $docType,
            $receipt->id,
            StateData::from([
                'state' => DocumentEventEnum::Canceled,
                'message' => fake()->text(),
            ])))
        ->toHaveProperty('status', InvoiceStatusEnum::Canceled)

        // Retrieve related documents (should be exactly 1)
        ->and($documentsList = $endpoint->getRelatedDocuments($invoice->id))
        ->toBeInstanceOf(EntityListData::class)
        ->and($documentsList->items())
        ->toHaveCount(1)

        // Check if it is the receipt previously created (generating a payment automatically creates a receipt)
        ->and($documentsList->items()->first())
        ->toHaveProperty('id', $receipt->id);
})->with('invoiceData');

it('can email an Invoice', function (array $data) {

    $invoiceData = InvoiceXpress::invoices()->list()->items()->first();
    $emailData = EmailData::from([
        'client' => EmailClientData::from([
            'email' => 'fake.email@nowhere.fast',
        ]),
        'subject' => 'Test',
        'body' => 'Test',
    ]);

    expect(fn () => InvoiceXpress::invoices()->sendByEmail(
        EntityTypeEnum::Invoice,
        $invoiceData->getId(),
        $emailData
    ))->not()->toThrow(RequestException::class);

})->with('invoiceData')
    ->depends('it can go through an invoice lifecycle');

it('can generate an Invoice PDF', function () {
    $invoiceData = InvoiceXpress::invoices()->list()->items()->first();

    expect(InvoiceXpress::invoices()->generatePDF($invoiceData->getId()))
        ->toBeInstanceOf(PdfData::class)
        ->pdfUrl->not()->toBeNull();

})->depends('it can go through an invoice lifecycle');

it('can get an Invoice QrCode', function () {
    $invoiceData = InvoiceXpress::invoices()
        ->list(InvoiceListFilter::from(['status' => [InvoiceStatusEnum::Sent]]))
        ->items()
        ->first();

    expect(InvoiceXpress::invoices()->getQRCode($invoiceData->getId()))
        ->toBeInstanceOf(QRCodeData::class)
        ->url->not()->toBeNull();

})->depends('it can go through an invoice lifecycle');

/*
 * DATASETS
 */
dataset(
    'invoiceData',
    [
        'Sample invoice' => [
            [
                'date' => now(),
                'due_date' => now()->addDays(random_int(10, 30)),
                'reference' => fake()->text(64),
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
