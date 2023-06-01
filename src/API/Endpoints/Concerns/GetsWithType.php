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
     * @return TData
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function get(EntityTypeEnum $documentType, int $id): EntityData
    {
        $data = $this->call(
            action: static::GET,
            urlParams: [
                'type' => $documentType->toUrlVariable(),
                'id' => $id,
            ],
        );

        return $this->responseToDataObject($data[$documentType->value]);
    }
}
