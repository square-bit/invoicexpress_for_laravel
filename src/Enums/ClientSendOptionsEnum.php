<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Enums;

use Squarebit\InvoiceXpress\Enums\Concerns\EnumEnhancements;

enum ClientSendOptionsEnum: int
{
    use EnumEnhancements;

    case ONE_COPY = 1;
    case TWO_COPIES = 2;
    case THREE_COPIES = 3;

    public function label(): string
    {
        return match ($this) {
            self::ONE_COPY => 'One copy',
            self::TWO_COPIES => 'Two copies',
            self::THREE_COPIES => 'Three copies',
        };
    }
}
