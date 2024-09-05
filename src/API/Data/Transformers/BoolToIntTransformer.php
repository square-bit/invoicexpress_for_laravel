<?php

namespace Squarebit\InvoiceXpress\API\Data\Transformers;

use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class BoolToIntTransformer implements Transformer
{
    public function transform(DataProperty $property, mixed $value, TransformationContext $context): int
    {
        return (int) $value;
    }
}
