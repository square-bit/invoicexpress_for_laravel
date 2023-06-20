<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

/**
 * @template T of EntityData
 */
trait CreatesWithType
{
    public const CREATE = 'create';

    /**
     * @param  T  $data
     * @return T
     *
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function create(EntityTypeEnum $entityType, EntityData $data): EntityData
    {
        $response = $this->call(
            action: static::CREATE,
            urlParams: ['type' => $entityType->toUrlVariable()],
            bodyData: [$entityType->value => $data->toCreateData()]
        );

        return $this->responseToDataObject($response[$entityType->value]);
    }
}
