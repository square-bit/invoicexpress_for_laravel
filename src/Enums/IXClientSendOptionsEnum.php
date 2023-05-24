<?php

namespace Squarebit\InvoiceXpress\Enums;

use Squarebit\InvoiceXpress\Concerns\EnumEnhancements;

enum IXClientSendOptionsEnum: int
{
    use EnumEnhancements;

    case ONE_COPY = 1;
    case TWO_COPIES = 2;
    case THREE_COPIES = 3;
}
