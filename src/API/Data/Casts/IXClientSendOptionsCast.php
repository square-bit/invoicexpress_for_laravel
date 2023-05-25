<?php

namespace Squarebit\InvoiceXpress\API\Data\Casts;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;
use Squarebit\InvoiceXpress\Enums\IXClientSendOptionsEnum;

class IXClientSendOptionsCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $context): IXClientSendOptionsEnum
    {
        return IXClientSendOptionsEnum::from($value);
    }
}
