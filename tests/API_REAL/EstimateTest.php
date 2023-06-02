<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Data\EstimateData;
use Squarebit\InvoiceXpress\API\Data\Filters\EstimateListFilter;
use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\API\Enums\DocumentEventEnum;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\EstimateStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\ItemUnitEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can go through an Estimate lifecycle', function (EntityTypeEnum $docType, array $data) {
    $endpoint = InvoiceXpress::estimates();

    $dataObject = EstimateData::from($data);
    expect($estimate = $endpoint->create($docType, $dataObject))
        ->not()->toThrow(Exception::class)
        ->and($estimate->toArray())
        ->toMatchArrayRecursive($data);

    // listing (with filter) a recently created Estimate sometimes does not find that estimate
    // Wait for a couple of seconds so the result is as expected...
    sleep(2);
    // list
    expect(InvoiceXpress::estimates()->list())
        ->toBeInstanceOf(EntityListData::class)
        ->items()->count()->toBeGreaterThanOrEqual(1) // we accept greaterThan since the account might have more Clients
        ->and(InvoiceXpress::estimates()->list(EstimateListFilter::from(['reference' => $estimate->reference])))
        ->items()->count()->toBe(1);

    $modified = $estimate->reference = fake()->text(32);
    expect(fn () => $endpoint->update($docType, $estimate))
        ->not()->toThrow(Exception::class)
        ->and($estimate = $endpoint->get($docType, $estimate->id))
        ->toHaveProperty('reference', $modified)
        ->and($endpoint->changeState($docType, $estimate->id, StateData::from(['state' => DocumentEventEnum::Deleted])))
        ->toHaveProperty('status', EstimateStatusEnum::Deleted);
})->with([
    EntityTypeEnum::Quote->name => EntityTypeEnum::Quote,
    EntityTypeEnum::Proforma->name => EntityTypeEnum::Proforma,
    EntityTypeEnum::FeesNote->name => EntityTypeEnum::FeesNote,
])->with('estimateData')
    ->skip(! TEST_REAL_API);

/*
 * DATASETS
 */
dataset(
    'estimateData',
    [
        'Sample estimate' => [
            [
                'date' => now()->format(\Squarebit\InvoiceXpress\InvoiceXpress::DATE_FORMAT),
                'due_date' => now()->addDays(random_int(10, 30))->format(\Squarebit\InvoiceXpress\InvoiceXpress::DATE_FORMAT),
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
                        // 'quantity' => random_int(1, 5),
                        'unit' => collect(ItemUnitEnum::values())->random(),
                        //'discount' => collect([5, 10, 15, 20, 50])->random(),
                        'tax' => [
                            'name' => 'IVA23',
                        ],
                    ],
                ],
            ],
        ],
    ]
);
