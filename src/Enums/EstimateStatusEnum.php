<?php

/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Enums;

use Squarebit\InvoiceXpress\Enums\Concerns\EnumEnhancements;

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
