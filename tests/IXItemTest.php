<?php

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Enums\IXItemUnitEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can create / update /delete an item', function (array $itemData) {
    // create the item
    $item = InvoiceXpress::item()->create(ItemData::from($itemData));
    expect($item->toArray())->toMatchArrayRecursive($itemData);

    // get it
    $gotItem = InvoiceXpress::item()->get($item->id);
    expect($gotItem->toArray())->toEqual($item->toArray());

    // update it
    $description = $gotItem->description = fake()->text(128);
    InvoiceXpress::item()->update($gotItem->id, $gotItem);

    // confirm it was updated, delete it and confirm it is gone
    $gotItem = InvoiceXpress::item()->get($gotItem->id);
    expect($gotItem->description)
        ->toEqual($description)
        ->and(fn () => InvoiceXpress::item()->delete($gotItem->id))
        ->not()->toThrow(Exception::class)
        ->and(fn () => InvoiceXpress::item()->get($gotItem->id))
        ->toThrow(RequestException::class);

})->with([
    [
        [
            'name' => fake()->colorName,
            'description' => fake()->text(128),
            'unit_price' => fake()->randomFloat(2, 0, 100),
            'unit' => collect(IXItemUnitEnum::values())->random(),
            'tax' => [
                'name' => 'IVA23',
            ],
        ],
    ],
]);
