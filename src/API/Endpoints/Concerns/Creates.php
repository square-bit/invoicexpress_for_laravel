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
 * @template TData of EntityData
 */
trait Creates
{
    use CreatesWithType {
        create as createWithType;
    }

    public const CREATE = 'create';

    abstract protected function getEntityType(): EntityTypeEnum;

    /**
     * @param  TData  $data
     * @return TData
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function create(EntityData $data): EntityData
    {
        return $this->createWithType($this->getEntityType(), $data);
    }
}
