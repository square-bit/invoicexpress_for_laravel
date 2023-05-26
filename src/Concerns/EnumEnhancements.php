<?php

namespace Squarebit\InvoiceXpress\Concerns;

use BackedEnum;
use ValueError;

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
        $cases = static::cases();

        return $cases[0] instanceof BackedEnum
            ? array_column($cases, 'value', 'name')
            : array_column($cases, 'name');
    }

    public static function labelArray(): array
    {
        $values = [];
        foreach (self::cases() as $enum) {
            $values[$enum->value] = $enum->label();
        }

        return $values;
    }

    public function label(): string
    {
        return is_numeric($this->value)
            ? __($this->name)
            : __($this->value);
    }

    /**
     * Returns enum values as a list.
     */
    public static function valueList(string $separator = ', '): string
    {
        return implode($separator, self::values());
    }

    public static function fromName(string $name): static
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name) {
                return $status;
            }
        }
        throw new ValueError("$name is not a valid backing value for enum ".self::class);
    }

    public static function tryFromName(string $name): ?static
    {
        try {
            return self::fromName($name);
        } catch (ValueError) {
            return null;
        }
    }
}
