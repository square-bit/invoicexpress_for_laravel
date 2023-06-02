<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */
use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\PaginationFilter;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Enums\ItemUnitEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can create / update /delete an Item', function (array $itemData) {
    // create the item
    $item = InvoiceXpress::items()->create(ItemData::from($itemData));
    expect($item->toArray())->toMatchArrayRecursive($itemData);

    // get it
    $gotItem = InvoiceXpress::items()->get($item->id);
    expect($gotItem->toArray())->toEqual($item->toArray());

    // list
    expect(InvoiceXpress::items()->list())
        ->toBeInstanceOf(EntityListData::class)
        ->items()->count()->toBeGreaterThanOrEqual(1) // we accept greaterThan since the account might have more Clients
        ->and(InvoiceXpress::items()->list(PaginationFilter::from(['per_page' => 1])))
        ->items()->count()->toBe(1);

    // update it
    $description = $gotItem->description = fake()->text(128);
    InvoiceXpress::items()->update($gotItem);

    // confirm it was updated, delete it and confirm it is gone
    $gotItem = InvoiceXpress::items()->get($gotItem->id);
    expect($gotItem->description)
        ->toEqual($description)
        ->and(fn () => InvoiceXpress::items()->delete($gotItem->id))
        ->not()->toThrow(Exception::class)
        ->and(fn () => InvoiceXpress::items()->get($gotItem->id))
        ->toThrow(RequestException::class);

})->with([
    [
        [
            'name' => fake()->colorName,
            'description' => fake()->text(128),
            'unit_price' => fake()->randomFloat(2, 0, 100),
            'unit' => collect(ItemUnitEnum::values())->random(),
            'tax' => [
                'name' => 'IVA23',
            ],
        ],
    ],
])->skip(! TEST_REAL_API);
