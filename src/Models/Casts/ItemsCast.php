<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Spatie\LaravelData\DataCollection;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\Models\IxItem;

class ItemsCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): Collection
    {
        return collect(is_string($value) ? json_decode($value, true) : $value)
            ->map(fn ($item) => match (true) {
                $item instanceof IxItem => $item->getData(),
                $item instanceof ItemData => $item,
                is_array($item) => ItemData::from($item),
                default => throw new InvalidArgumentException('The given entry cannot be converted to an ItemData instance'),
            });
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        if (! $value instanceof Collection && ! is_array($value) && ! $value instanceof DataCollection) {
            throw new InvalidArgumentException('The given value is not a collection of ItemData instances.');
        }

        return ['items' => $value->toJson()];
    }
}
