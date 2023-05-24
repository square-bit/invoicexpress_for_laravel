<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class PaginationData extends EntityData
{
    public function __construct(
        public int $currentPage,
        public int $totalPages,
        public int $totalEntries,
        public int $perPage,
    ) {
    }
}
