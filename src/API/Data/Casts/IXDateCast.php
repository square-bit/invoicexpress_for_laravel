<?php

namespace Squarebit\InvoiceXpress\API\Data\Casts;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;
use Squarebit\InvoiceXpress\InvoiceXpress;

class IXDateCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $context): ?Carbon
    {
        return Carbon::createFromFormat(InvoiceXpress::DATE_FORMAT, $value);
    }
}
