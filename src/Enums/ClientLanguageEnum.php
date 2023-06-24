<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Enums;

use Squarebit\InvoiceXpress\Enums\Concerns\EnumEnhancements;

enum ClientLanguageEnum: string
{
    use EnumEnhancements;

    case PT = 'pt';
    case EN = 'en';
    case ES = 'es';
}
