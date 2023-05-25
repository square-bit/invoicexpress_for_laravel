<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Throwable;

/**
 * @template TData of EntityData
 */
trait IXApiCreate
{
    public const CREATE = 'create';

    /**
     * @param  TData  $modelData
     * @return TData
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function create(EntityData $modelData): EntityData
    {
        $data = $this->call(
            action: static::CREATE,
            bodyData: [$this->getJsonRootObjectKey() => $modelData]
        );

        return $this->responseToDataObject($data[$this->getJsonRootObjectKey()]);
    }
}
