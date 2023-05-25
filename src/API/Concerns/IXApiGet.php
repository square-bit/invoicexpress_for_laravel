<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Throwable;

/**
 * @template TData of EntityData
 */
trait IXApiGet
{
    public const GET = 'get';

    /**
     * @return TData
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function get(int $id): EntityData
    {
        $data = $this->call(
            action: static::GET,
            urlParams: compact('id')
        );

        return $this->responseToDataObject($data[$this->getJsonRootObjectKey()]);
    }
}
