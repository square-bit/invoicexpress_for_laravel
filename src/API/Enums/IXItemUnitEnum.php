<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\Concerns\EnumEnhancements;

enum IXItemUnitEnum: string
{
    use EnumEnhancements;

    case Hour = 'hour';
    case Day = 'day';
    case Month = 'month';
    case Unit = 'unit';
    case Service = 'service';
    case Other = 'other';
}
