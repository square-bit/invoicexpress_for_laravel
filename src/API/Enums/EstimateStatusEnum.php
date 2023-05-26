<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\Concerns\EnumEnhancements;

enum EstimateStatusEnum: string
{
    use EnumEnhancements;

    case Draft = 'draft';
    case Settled = 'settled';
    case Canceled = 'canceled';
    case Deleted = 'deleted';
    case Final = 'final';
    case Accepted = 'accepted';
    case Refused = 'refused';
}
