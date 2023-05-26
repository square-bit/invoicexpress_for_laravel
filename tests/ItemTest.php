<?php

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Enums\ItemUnitEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can create / update /delete an Item', function (array $itemData) {
    // create the item
    $item = InvoiceXpress::items()->create(ItemData::from($itemData), ItemData::from($itemData));
    expect($item->toArray())->toMatchArrayRecursive($itemData);

    // get it
    $gotItem = InvoiceXpress::items()->get($item->id, $item->id);
    expect($gotItem->toArray())->toEqual($item->toArray());

    // update it
    $description = $gotItem->description = fake()->text(128);
    InvoiceXpress::items()->update($gotItem->id, $gotItem);

    // confirm it was updated, delete it and confirm it is gone
    $gotItem = InvoiceXpress::items()->get($gotItem->id, $gotItem->id);
    expect($gotItem->description)
        ->toEqual($description)
        ->and(fn () => InvoiceXpress::items()->delete($gotItem->id))
        ->not()->toThrow(Exception::class)
        ->and(fn () => InvoiceXpress::items()->get($gotItem->id, $gotItem->id))
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
]);
