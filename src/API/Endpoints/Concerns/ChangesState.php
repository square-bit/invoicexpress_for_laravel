<?php

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

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
    public function changeState(EntityTypeEnum $entityType, int $id, StateData $data): EntityData
    {
        $response = $this->call(
            action: static::CHANGE_STATE,
            urlParams: [
                'type' => $entityType->toUrlVariable(),
                'id' => $id,
            ],
            bodyData: [$entityType->value => $data->toArray()]
        );

        return $this->responseToDataObject($response[$entityType->value]);
    }
}
