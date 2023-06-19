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
trait GetsWithType
{
    public const GET = 'get';

    /**
     * @return TData|EntityData
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function get(EntityTypeEnum $entityType, int $id): EntityData
    {
        $data = $this->call(
            action: static::GET,
            urlParams: [
                'type' => $entityType->toUrlVariable(),
                'id' => $id,
            ],
        );

        return $this->responseToDataObject($data[$entityType->value]);
    }
}
