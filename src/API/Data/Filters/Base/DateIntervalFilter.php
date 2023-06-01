<?php

namespace Squarebit\InvoiceXpress\API\Data\Filters\Base;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapName(SnakeCaseMapper::class)]
class DateIntervalFilter extends Data
{
    public function __construct(
        public Optional|Carbon $from,
        public Optional|Carbon $to,
    ) {
    }
}
