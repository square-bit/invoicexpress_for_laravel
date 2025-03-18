<?php

/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Enums;

use Squarebit\InvoiceXpress\Enums\Concerns\EnumEnhancements;

enum ItemUnitEnum: string
{
    use EnumEnhancements;

    case Hour = 'hour';
    case Day = 'day';
    case Month = 'month';
    case Unit = 'unit';
    case Service = 'service';
    case Other = 'other';
}
