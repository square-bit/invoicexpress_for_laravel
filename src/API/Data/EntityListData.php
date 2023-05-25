<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

/**
 * @template T of EntityData
 *
 * @property array<T> $items
 */
#[MapName(SnakeCaseMapper::class)]
class EntityListData extends Data
{
    public function __construct(
        public array $items,
        public ?PaginationData $pagination,
    ) {
    }

    /**
     * @return Collection<T>
     */
    public function items(): Collection
    {
        return collect($this->items);
    }
}