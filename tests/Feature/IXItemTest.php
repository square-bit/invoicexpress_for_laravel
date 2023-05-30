<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Enums\ItemUnitEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;
use Squarebit\InvoiceXpress\Models\IxItem;

beforeEach(function () {
    $this->store['item'] = InvoiceXpress::items()->create(ItemData::from([
        'name' => fake()->colorName,
        'description' => fake()->text(128),
        'unit_price' => fake()->randomFloat(2, 0, 100),
        'unit' => collect(ItemUnitEnum::values())->random(),
        'tax' => [
            'name' => 'IVA23',
        ],
    ]));
});

it('can get, store, update and delete an Item, locally and remotely', function () {

    expect($item = IxItem::find($this->store['item']->getId()))
        ->name->toBe($this->store['item']->name)
        ->description->toBe($this->store['item']->description)
        ->unit_price->toBe($this->store['item']->unitPrice)
        ->unit->toBe($this->store['item']->unit)
        ->tax->scoped(fn ($tax) => $tax->name->toBe($this->store['item']->tax->name))
        ->exists->toBeTrue();

    $newDesc = $item->description = fake()->text();
    expect($item->save())->toBeTrue()
        ->and($item = $item->fresh())
        ->description->toBe($newDesc)
        ->and(InvoiceXpress::items()->get($item->id))
        ->toHaveProperty('description', $newDesc);

    expect($item->delete())->toBeTrue()
        ->and(IxItem::count())->toBe(0)
        ->and(IxItem::find($item->id))
        ->toBeNull();

})->skip(
    fn () => config('invoicexpress-for-laravel.eloquent.persist') === false,
    'Eloquent persistence not enabled. Check config.'
);
