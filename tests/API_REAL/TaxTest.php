<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */
use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\TaxData;
use Squarebit\InvoiceXpress\API\Enums\TaxCodeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxRegionEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

it('can create / update /delete a Tax', function (array $taxData) {

    $tax = InvoiceXpress::taxes()->create(TaxData::from($taxData));
    expect($tax->toArray())->toMatchArrayRecursive($taxData);

    // get it
    $gotTax = InvoiceXpress::taxes()->get($tax->id);
    expect($gotTax->toArray())->toEqual($tax->toArray());

    // update it
    $value = $gotTax->value = 6;
    InvoiceXpress::taxes()->update($gotTax);

    // confirm it was updated, delete it and confirm it is gone
    $gotTax = InvoiceXpress::taxes()->get($gotTax->id);
    expect($gotTax->value)
        ->toEqual($value)
        ->and(fn () => InvoiceXpress::taxes()->delete($gotTax->id))
        ->not()->toThrow(Exception::class)
        ->and(fn () => InvoiceXpress::taxes()->get($gotTax->id))
        ->toThrow(RequestException::class);

})->with([
    [
        [
            'name' => 'fair_tax',
            'value' => '5.2',
            'region' => TaxRegionEnum::PortugalMadeiraPT->value,
            'code' => TaxCodeEnum::OtherRate->value,
            'default_tax' => 0,
        ],
    ],
]);
