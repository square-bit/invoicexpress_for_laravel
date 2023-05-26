<?php

namespace Squarebit\InvoiceXpress\API\Data\Transformers;

use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Transformers\Transformer;

class BoolToIntTransformer implements Transformer
{
    /**
     * @param  \Squarebit\InvoiceXpress\API\Enums\TaxExemptionCodeEnum  $value
     */
    public function transform(DataProperty $property, mixed $value): int
    {
        return (int) $value;
    }
}
