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
}
