<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

abstract class EntityData extends Data
{
    public Optional|int $id;

    public const CREATE_PROPERTIES = [];

    public const UPDATE_PROPERTIES = [];

    public const USE_PROPERTIES = [];

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

    protected static function getCreateProperties(): array
    {
        return static::CREATE_PROPERTIES;
    }

    protected static function getUpdateProperties(): array
    {
        return static::UPDATE_PROPERTIES;
    }

    protected static function getUseProperties(): array
    {
        return static::USE_PROPERTIES;
    }

    public function toCreateData(): static
    {
        return count($data = static::getCreateProperties())
            ? static::from($this)->only(...$data)
            : static::from($this);
    }

    public function toUpdateData(): static
    {
        return count($data = static::getUpdateProperties())
            ? static::from($this)->only(...$data)
            : static::from($this);
    }

    public function toUseData(): static
    {
        return count($data = static::getUseProperties())
            ? static::from($this)->only(...$data)
            : static::from($this);
    }

    public function toModelData(): static
    {
        return $this;
    }
}
