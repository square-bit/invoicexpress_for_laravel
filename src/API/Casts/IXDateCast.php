<?php

namespace Squarebit\InvoiceXpress\API\Casts;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class IXDateCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $context): ?Carbon
    {
        return Carbon::createFromFormat('d/m/Y', $value);
    }
}
