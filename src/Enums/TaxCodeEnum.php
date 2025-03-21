<?php

/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Enums;

use Squarebit\InvoiceXpress\Enums\Concerns\EnumEnhancements;

enum TaxCodeEnum: string
{
    use EnumEnhancements;

    case Normal = 'NOR';
    case Intermediate = 'INT';
    case Reduced = 'RED';
    case OtherRate = 'OUT';
    case Exempt = 'ISE';
}
