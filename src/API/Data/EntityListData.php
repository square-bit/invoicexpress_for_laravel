<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

/**
 * @template T of EntityData
 * @property array<T>
 */
#[MapName(SnakeCaseMapper::class)]
class EntityListData extends EntityData
{
    public function __construct(
        public array $items,
        public ?PaginationData $pagination,
    ) {
    }

    public function items(): Collection
    {
        return collect($this->items);
    }
}
