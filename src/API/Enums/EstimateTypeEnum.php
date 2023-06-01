<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\API\Enums\Concerns\ConvertsToEntityTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\Concerns\EnumEnhancements;

enum EstimateTypeEnum: string
{
    use EnumEnhancements;
    use ConvertsToEntityTypeEnum;

    case Quote = 'Quote';
    case Proforma = 'Proforma';
    case FeesNote = 'FeesNote';
}
