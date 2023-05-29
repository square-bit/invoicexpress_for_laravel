<?php

namespace Squarebit\InvoiceXpress\API\Data\Transformers;

use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Transformers\Transformer;

class BoolToStringTransformer implements Transformer
{
    public function transform(DataProperty $property, mixed $value): string
    {
        return $value ? 'true' : 'false';
    }
}
