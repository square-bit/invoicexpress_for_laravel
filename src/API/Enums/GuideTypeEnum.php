<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\API\Enums\Concerns\ConvertsToEntityTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\Concerns\EnumEnhancements;

enum GuideTypeEnum: string
{
    use EnumEnhancements;
    use ConvertsToEntityTypeEnum;

    case Shipping = 'Shipping';
    case Transport = 'Transport';
    case Devolution = 'Devolution';
}
