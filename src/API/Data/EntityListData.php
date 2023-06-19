<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

/**
 * @template T of EntityData
 *
 * @property array<int, T> $items
 */
#[MapName(SnakeCaseMapper::class)]
class EntityListData extends Data
{
    public function __construct(
        public array $items,
        public Optional|PaginationData $pagination,
    ) {
    }

    /**
     * @return Collection<int, T>
     */
    public function items(): Collection
    {
        return collect($this->items);
    }
}
