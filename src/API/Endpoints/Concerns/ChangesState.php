<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

/**
 * @template TData of EntityData
 */
trait ChangesState
{
    public const CHANGE_STATE = 'change-state';

    /**
     * @return TData
     *
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function changeState(EntityTypeEnum $documentType, int $id, StateData $data): EntityData
    {
        $response = $this->call(
            action: static::CHANGE_STATE,
            urlParams: [
                'type' => $documentType->toUrlVariable(),
                'id' => $id,
            ],
            bodyData: [$documentType->value => $data->toArray()]
        );

        return $this->responseToDataObject($response[$documentType->value]);
    }
}
