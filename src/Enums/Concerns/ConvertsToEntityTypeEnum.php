<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Enums\Concerns;

use Illuminate\Support\Str;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

trait ConvertsToEntityTypeEnum
{
    public function toEntityType(): ?EntityTypeEnum
    {
        return EntityTypeEnum::tryFrom(Str::snake($this->value));
    }
}
