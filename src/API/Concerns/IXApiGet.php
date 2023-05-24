<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Spatie\LaravelData\Data;
use Throwable;

/**
 * @template TData of Data
 */
trait IXApiGet
{
    public const GET = 'get';

    /**
     * @param  int  $id
     * @return TData
     * @throws RequestException
     * @throws Throwable
     */
    public function get(int $id): Data
    {
        $data = $this->call(
            action: static::GET,
            urlParams: compact('id')
        );

        return $this->responseToDataObject($data[$this->getJsonRootObjectKey()]);
    }
}
