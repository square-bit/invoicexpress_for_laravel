<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\API\Enums\Concerns;

trait EnumEnhancements
{
    public static function names(): array
    {
        return array_column(static::cases(), 'name');
    }

    /**
     * Returns enum values as an array.
     */
    public static function values(): array
    {
        foreach (self::cases() as $enum) {
            $values[] = $enum->value ?? $enum->name;
        }

        return $values;
    }
}
