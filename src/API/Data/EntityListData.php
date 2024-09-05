<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\PaginationFilter;

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
    ) {}

    /**
     * @return Collection<int, T>
     */
    public function items(): Collection
    {
        return collect($this->items);
    }

    public function hasMorePages(): bool
    {
        return $this->pagination instanceof PaginationData &&
            $this->pagination->currentPage < $this->pagination->totalPages;
    }

    public function nextPageFilter(): ?PaginationFilter
    {
        return $this->pagination instanceof PaginationData
            ? PaginationFilter::from([
                'page' => $this->pagination->currentPage + 1,
                'per_page' => $this->pagination->perPage,
            ])
            : null;
    }
}
