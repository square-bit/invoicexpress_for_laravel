<?php

namespace Squarebit\InvoiceXpress\API\Data\Transformers;

use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Transformers\Transformer;

class EnumArrayTransformer implements Transformer
{
    public function transform(DataProperty $property, mixed $value): array
    {
        return array_map(fn ($case) => $case->value, $value);
    }
}
