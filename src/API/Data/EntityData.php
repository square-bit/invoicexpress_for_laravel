<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

abstract class EntityData extends Data
{
    public Optional|int $id;

    public const CREATE_PROPERTIES = null;

    public const UPDATE_PROPERTIES = null;

    public const USE_PROPERTIES = null;

    public function getId(): ?int
    {
        return $this->id instanceof Optional ? null : $this->id;
    }

    protected static function prefixProperties(string $prefix, array $properties): array
    {
        return collect($properties)
            ->map(fn ($item) => $prefix.'.'.$item)
            ->all();
    }

    public function toCreateData(): static
    {
        return static::CREATE_PROPERTIES
            ? static::from($this)->only(...static::CREATE_PROPERTIES)
            : static::from($this);
    }

    public function toUpdateData(): static
    {
        return static::UPDATE_PROPERTIES
            ? static::from($this)->only(...static::UPDATE_PROPERTIES)
            : static::from($this);
    }

    public function toUseData(): static
    {
        return static::USE_PROPERTIES
            ? static::from($this)->only(...static::USE_PROPERTIES)
            : static::from($this);
    }

    public function toModelData(): static
    {
        return $this;
    }
}
