<?php

namespace Squarebit\InvoiceXpress\API\Data\Filters\Base;

use Spatie\LaravelData\Optional;

class PaginationFilter extends QueryFilter
{
    public function __construct(
        public Optional|int $page,
        public Optional|int $perPage,
    ) {
    }
}
