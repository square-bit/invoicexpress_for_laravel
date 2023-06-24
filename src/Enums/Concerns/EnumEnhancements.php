<?php

namespace Squarebit\InvoiceXpress\Enums\Concerns;

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

    /**
     * Returns enum values as an associative array.
     */
    public static function options(): array
    {
        return collect(static::cases())
            ->mapWithKeys(fn ($case, $key) => [$case->value => $case->label()])->all();
    }

    public function label(): string
    {
        return $this->value;
    }
}
