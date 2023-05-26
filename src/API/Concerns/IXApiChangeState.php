<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Data\StateData;

/**
 * @template TData of EntityData
 */
trait IXApiChangeState
{
    public const CHANGE_STATE = 'change-state';

    /**
     * @param  TData  $data
     * @return TData
     *
     * @throws RequestException
     * @throws
     */
    public function changeState(int $id, StateData $data): EntityData
    {
        $response = $this->call(
            action: static::CHANGE_STATE,
            urlParams: compact('id'),
            bodyData: [$this->getJsonRootObjectKey() => $data->toArray()]
        );

        return $this->responseToDataObject($response[$this->getJsonRootObjectKey()]);
    }
}
