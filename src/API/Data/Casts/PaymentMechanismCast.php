<?php

namespace Squarebit\InvoiceXpress\API\Data\Casts;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;
use Squarebit\InvoiceXpress\API\Enums\PaymentMechanismEnum;

class PaymentMechanismCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $context): PaymentMechanismEnum
    {
        return PaymentMechanismEnum::fromName($value);
    }
}
