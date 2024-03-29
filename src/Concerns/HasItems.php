<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Spatie\LaravelData\DataCollection;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\Models\IxItem;

trait HasItems
{
    public function addItem(ItemData|IxItem|array $item, float $quantity = 1, ?float $value = null): static
    {
        /** @var ItemData $itemData */
        $itemData = match (true) {
            $item instanceof ItemData => $item,
            $item instanceof IxItem => $item->getData(),
            is_array($item) => ItemData::from($item)
        };

        $itemData->quantity = $quantity;
        $itemData->unitPrice = $value ?? $itemData->unitPrice;

        /** @phpstan-ignore-next-line */
        $items = $this->items?->all() ?? [];
        $items[] = $itemData->except('id');

        $this->items = new DataCollection(ItemData::class, $items);

        return $this;
    }

    /**
     * @param  array|Collection<int, ItemData>  $items
     * @return $this
     */
    public function addItems(array|Collection $items): static
    {
        collect($items)->each(fn ($item) => $this->addItem(...Arr::wrap($item)));

        return $this;
    }
}
