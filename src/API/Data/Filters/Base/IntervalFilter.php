<?php

namespace Squarebit\InvoiceXpress\API\Data\Filters\Base;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

/**
 * @template T
 */
#[MapName(SnakeCaseMapper::class)]
class IntervalFilter extends Data
{
    /**
     * @param  mixed|T  $from
     * @param  mixed|T  $to
     */
    public function __construct(
        public mixed $from,
        public mixed $to,
    ) {
    }
}
