<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Data;

abstract class EntityData extends Data
{
    public function toFilteredArray(?callable $callback = null): array
    {
        return array_filter($this->toArray(), $callback);
    }

}
