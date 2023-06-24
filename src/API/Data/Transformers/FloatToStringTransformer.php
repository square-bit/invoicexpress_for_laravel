<?php

namespace Squarebit\InvoiceXpress\API\Data\Transformers;

use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Transformers\Transformer;

class FloatToStringTransformer implements Transformer
{
    public function transform(DataProperty $property, mixed $value): string
    {
        return number_format($value, 2, '.', '');
    }
}
