<?php

/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Enums;

use Squarebit\InvoiceXpress\Enums\Concerns\EnumEnhancements;

enum InvoiceStatusEnum: string
{
    use EnumEnhancements;

    case Draft = 'draft';
    case Settled = 'settled';
    case Canceled = 'canceled';
    case Deleted = 'deleted';
    case Final = 'final';
    case Sent = 'sent'; // TODO this should be removed since it is an incoherence in the API
}
