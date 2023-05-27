<?php

namespace Squarebit\InvoiceXpress\API\Enums\Concerns;

use Illuminate\Support\Str;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

trait ConvertsToEntityTypeEnum
{
    public function toEntityType(): ?EntityTypeEnum
    {
        return EntityTypeEnum::tryFrom(Str::snake($this->value));
    }
}
