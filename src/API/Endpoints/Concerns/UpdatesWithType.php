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
trait UpdatesWithType
{
    public const UPDATE = 'update';

    /**
     * @param  T  $data
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function update(EntityTypeEnum $documentType, EntityData $data): void
    {
        $this->call(
            action: static::UPDATE,
            urlParams: [
                'type' => $documentType->toUrlVariable(),
                'id' => $data->getId(),
            ],
            bodyData: [$documentType->value => $data->toArray()]
        );
    }
}
