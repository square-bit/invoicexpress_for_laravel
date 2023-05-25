<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;

/**
 * @template TData of EntityData
 */
trait IXApiChangeState
{
    public const CHANGE_STATE = 'change-state';

    /**
     * @param  TData  $modelData
     * @return TData
     *
     * @throws RequestException
     * @throws
     */
    public function changeState(int $id, EntityData $modelData): EntityData
    {
        $data = $this->call(
            action: static::CHANGE_STATE,
            urlParams: compact('id'),
            bodyData: [$this->getJsonRootObjectKey() => $modelData]
        );

        return $this->responseToDataObject($data[$this->getJsonRootObjectKey()]);
    }
}
