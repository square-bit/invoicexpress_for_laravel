<?php

namespace Squarebit\InvoiceXpress\API\Data\Filters\Base;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapName(SnakeCaseMapper::class)]
class NumberIntervalFilter extends Data
{
    public function __construct(
        public Optional|float $from,
        public Optional|float $to,
    ) {}
}
