<?php

namespace Squarebit\InvoiceXpress\API\Data\Filters\Base;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapName(SnakeCaseMapper::class)]
class PaginationFilter extends QueryFilter
{
    public function __construct(
        public Optional|int $page,
        public Optional|int $perPage,
    ) {
    }
}
