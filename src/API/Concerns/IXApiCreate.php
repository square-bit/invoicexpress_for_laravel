<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Spatie\LaravelData\Data;
use Throwable;

/**
 * @template TData of Data
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
    public function create(Data $modelData)
    {
        $data = $this->call(
            action: static::CREATE,
            bodyData: [$this->getJsonRootObjectKey() => $modelData]
        );

        return $this->responseToDataObject($data[$this->getJsonRootObjectKey()]);
    }
}
