<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\API\Enums\Concerns\EnumEnhancements;

enum TaxCodeEnum: string
{
    use EnumEnhancements;

    case Normal = 'NOR';
    case Intermediate = 'INT';
    case Reduced = 'RED';
    case OtherRate = 'OUT';
    case Exempt = 'ISE';
}
