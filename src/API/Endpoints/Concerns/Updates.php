<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Throwable;

/**
 * @template T of EntityData
 */
trait Updates
{
    use UpdatesWithType {
        update as updateWithType;
    }

    public const UPDATE = 'update';

    abstract protected function getEntityType(): EntityTypeEnum;

    /**
     * @throws RequestException
     * @throws Throwable
     */
    public function update(EntityData $data): void
    {
        $this->updateWithType($this->getEntityType(), $data);
    }
}
