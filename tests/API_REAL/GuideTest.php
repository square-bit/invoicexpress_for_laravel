<?php

use Squarebit\InvoiceXpress\API\Data\GuideData;
use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\Enums\CountryEnum;
use Squarebit\InvoiceXpress\Enums\DocumentEventEnum;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Enums\EstimateStatusEnum;
use Squarebit\InvoiceXpress\Enums\ItemUnitEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can go through an Guide lifecycle', function (EntityTypeEnum $docType, array $data) {
    $endpoint = InvoiceXpress::guides();

    $dataObject = GuideData::from($data);
    expect($guide = $endpoint->create($docType, $dataObject))
        ->not()->toThrow(Exception::class)
        ->and($guide->type->toEntityType())
        ->toEqual($docType)
        ->and($guide->id)
        ->toBeGreaterThan(0);

    $modified = $guide->reference = fake()->text(32);
    expect(fn () => $endpoint->update($docType, $guide))
        ->not()->toThrow(Exception::class)
        ->and($guide = $endpoint->get($docType, $guide->id))
        ->toHaveProperty('reference', $modified)
        ->and($endpoint->changeState($docType, $guide->id, StateData::from(['state' => DocumentEventEnum::Deleted])))
        ->toHaveProperty('status', EstimateStatusEnum::Deleted);
})->with([
    EntityTypeEnum::Shipping->name => EntityTypeEnum::Shipping,
    EntityTypeEnum::Transport->name => EntityTypeEnum::Transport,
    EntityTypeEnum::Devolution->name => EntityTypeEnum::Devolution,
])->with('guideData')
    ->skip(! TEST_REAL_API)
    ->skip('Until InvoiceXpress solves the bugs');

/*
 * DATASETS
 */
dataset(
    'guideData',
    [
        'Sample guide' => [
            [
                // 'loaded_at' cannot be in the past, so we always add at least 1 day since, when testing
                // against the real InvoiceXpress endpoints, we might be sending a past datetime (due
                // to timezone differences). This will not be a problem when we use this package
                // in a project with a proper timezone configuration set in config/app.php.
                'loaded_at' => now()->addDay()->format(\Squarebit\InvoiceXpress\InvoiceXpress::DATE_TIME_FORMAT),
                'date' => now()->addDay()->format(\Squarebit\InvoiceXpress\InvoiceXpress::DATE_FORMAT),
                'due_date' => now()->addDays(random_int(10,
                    30))->format(\Squarebit\InvoiceXpress\InvoiceXpress::DATE_FORMAT),
                'reference' => fake()->colorName,
                'observations' => fake()->text(128),
                'address_from' => [
                    'detail' => 'Rua 5',
                    'city' => 'Lisboa',
                    'postal_code' => '1000-555',
                    'country' => CountryEnum::Portugal->value,
                ],
                'address_to' => [
                    'detail' => 'Avenida 0',
                    'city' => 'Madrid',
                    'postal_code' => '2000555',
                    'country' => CountryEnum::Spain->value,
                ],
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
