<?php

namespace Squarebit\InvoiceXpress\API\Data\Casts;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;
use Squarebit\InvoiceXpress\API\Enums\ClientSendOptionsEnum;

class IXClientSendOptionsCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $context): ClientSendOptionsEnum
    {
        return ClientSendOptionsEnum::from($value);
    }
}
