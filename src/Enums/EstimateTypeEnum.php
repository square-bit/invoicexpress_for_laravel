<?php

/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Enums;

use Squarebit\InvoiceXpress\Enums\Concerns\ConvertsToEntityTypeEnum;
use Squarebit\InvoiceXpress\Enums\Concerns\EnumEnhancements;

enum EstimateTypeEnum: string
{
    use ConvertsToEntityTypeEnum;
    use EnumEnhancements;

    case Quote = 'Quote';
    case Proforma = 'Proforma';
    case FeesNote = 'FeesNote';
}
