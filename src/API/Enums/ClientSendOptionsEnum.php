<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\API\Enums\Concerns\EnumEnhancements;

enum ClientSendOptionsEnum: int
{
    use EnumEnhancements;

    case ONE_COPY = 1;
    case TWO_COPIES = 2;
    case THREE_COPIES = 3;
}
