<?php

namespace Squarebit\InvoiceXpress\API\Data\Filters;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\PaginationFilter;

#[MapName(SnakeCaseMapper::class)]
class ClientListFilter extends PaginationFilter
{
}
