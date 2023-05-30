<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\API\Enums\Concerns\EnumEnhancements;

enum ClientLanguageEnum: string
{
    use EnumEnhancements;

    case PT = 'pt';
    case EN = 'en';
    case ES = 'es';
}
