<?php

namespace Squarebit\InvoiceXpress\Enums;

use Squarebit\InvoiceXpress\Concerns\EnumEnhancements;

enum IXClientLanguageEnum: string
{
    use EnumEnhancements;

    case PT = 'pt';
    case EN = 'en';
    case ES = 'es';
}
