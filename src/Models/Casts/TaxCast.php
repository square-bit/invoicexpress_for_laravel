<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Squarebit\InvoiceXpress\API\Data\TaxData;
use Squarebit\InvoiceXpress\Models\IxTax;

class TaxCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?TaxData
    {
        return match (true) {
            $value instanceof IxTax => $value->getData(),
            $value instanceof TaxData => $value,
            is_array($value) => TaxData::from($value),
            is_string($value) => TaxData::from(json_decode($value, true)),
            is_null($value) => null,
            default => throw new InvalidCastException($model, $key.'=>'.Str::limit($value, 25), static::class),
        };
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        $value = match (true) {
            $value instanceof IxTax => $value->getData(),
            $value instanceof TaxData => $value,
            is_array($value) => TaxData::from($value),
            is_string($value) => TaxData::from(json_decode($value, true)),
            is_null($value) => null,
            default => throw new InvalidCastException($model, $key.'=>'.Str::limit($value, 25), static::class),
        };

        return [$key => $value?->toJson()];
    }
}
