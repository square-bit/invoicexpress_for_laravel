<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\API\Enums\Concerns\EnumEnhancements;

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
