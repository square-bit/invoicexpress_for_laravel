<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\Concerns\EnumEnhancements;

enum GuideStatusEnum: string
{
    use EnumEnhancements;

    case Draft = 'draft';
    case Sent = 'sent';
    case Canceled = 'canceled';
    case SecondCopy = 'second_copy';
}