<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Concerns;

use Illuminate\Support\Collection;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\Models\IxItem;

trait HasItems
{
    public function addItem(ItemData|IxItem|array $item, float $quantity = 1, ?float $value = null): static
    {
        $itemData = match (true) {
            $item instanceof ItemData => $item,
            $item instanceof IxItem => $item->getData(),
            is_array($item) => ItemData::from($item)
        };

        $itemData->quantity = $quantity;
        $itemData->unitPrice = $value ?? $itemData->unitPrice;

        $this->items->add($itemData->except('id'));

        return $this;
    }

    public function addItems(array|Collection $items): static
    {
        collect($items)->each(fn ($item) => $this->addItem($item));

        return $this;
    }
}
