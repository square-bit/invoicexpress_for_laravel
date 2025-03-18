<?php

/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Enums;

use Squarebit\InvoiceXpress\Enums\Concerns\EnumEnhancements;

enum DocumentEventEnum: string
{
    use EnumEnhancements;

    case Finalized = 'finalized';
    case Deleted = 'deleted';
    case SecondCopy = 'second_copy';
    case Canceled = 'canceled';
    case Settled = 'settled';
    case Unsettled = 'unsettled';
    case Accept = 'accept';
    case Refuse = 'refuse';
}
