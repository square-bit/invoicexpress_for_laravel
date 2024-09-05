<?php

namespace Squarebit\InvoiceXpress\Enums\Concerns;

trait EnumEnhancements
{
    /**
     * @return array<int, string>
     */
    public static function names(): array
    {
        return array_column(static::cases(), 'name');
    }

    /**
     * @return array<int, string|int>
     */
    public static function values(): array
    {
        foreach (self::cases() as $enum) {
            $values[] = $enum->value ?? $enum->name;
        }

        return $values;
    }

    /**
     * @return array<int|string, int|string>
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
