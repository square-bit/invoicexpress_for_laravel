<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\Concerns\EnumEnhancements;

enum StateEnum: string
{
    use EnumEnhancements;

    case Finalized = 'finalized';
    case Deleted = 'deleted';
    case SecondCopy = 'second_copy';
    case Canceled = 'canceled';
    case Settled = 'settled';
    case Unsettled = 'unsettled';
}
