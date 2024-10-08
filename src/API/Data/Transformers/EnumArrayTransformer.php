<?php

namespace Squarebit\InvoiceXpress\API\Data\Transformers;

use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class EnumArrayTransformer implements Transformer
{
    public function transform(DataProperty $property, mixed $value, TransformationContext $context): array
    {
        return array_map(fn ($case) => $case->value, $value);
    }
}
