<?php

namespace Squarebit\InvoiceXpress\API\Data\Transformers;

use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Transformers\Transformer;
use Squarebit\InvoiceXpress\Enums\IXTaxExemptionCodeEnum;

class BoolToIntTransformer implements Transformer
{
    /**
     * @param  IXTaxExemptionCodeEnum  $value
     */
    public function transform(DataProperty $property, mixed $value): int
    {
        return (int) $value;
    }
}
