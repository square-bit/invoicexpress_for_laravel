<?php

namespace Squarebit\InvoiceXpress\API\Data\Casts;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;
use Squarebit\InvoiceXpress\Enums\IXTaxExemptionCodeEnum;

class IXTaxExemptionCodeCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $context): IXTaxExemptionCodeEnum
    {
        return IXTaxExemptionCodeEnum::fromName($value);
    }
}
