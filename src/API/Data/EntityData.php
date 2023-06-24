<?php

namespace Squarebit\InvoiceXpress\API\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

abstract class EntityData extends Data
{
    public Optional|int $id;

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
        return $this;
    }

    public function toUpdateData(): static
    {
        return $this;
    }

    public function toModelData(): static
    {
        return $this;
    }
}
