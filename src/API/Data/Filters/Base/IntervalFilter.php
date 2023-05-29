<?php

namespace Squarebit\InvoiceXpress\API\Data\Filters\Base;

use Spatie\LaravelData\Data;

/**
 * @template T
 */
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
