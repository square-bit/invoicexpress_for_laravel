<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\Concerns\EnumEnhancements;

enum DocumentStatusEnum: string
{
    use EnumEnhancements;

    case Draft = 'draft';
    case Settled = 'settled';
    case Canceled = 'canceled';
    case Deleted = 'deleted';
    case Final = 'final';
}
