<?php

use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Data\EstimateData;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Data\PartialPaymentData;
use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\API\Enums\DocumentStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\InvoiceTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\ItemUnitEnum;
use Squarebit\InvoiceXpress\API\Enums\StateEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can go through an Estimate lifecycle', function (array $data) {
    $endpoint = InvoiceXpress::estimates();

    $dataObject = EstimateData::from($data);
    expect($estimate = $endpoint->create(DocumentTypeEnum::FeesNote, $dataObject))
        ->not()->toThrow(Exception::class);

})->with('estimateData');

/*
 * DATASETS
 */
dataset(
    'estimateData',
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
