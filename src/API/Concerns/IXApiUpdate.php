<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Spatie\LaravelData\Data;
use Throwable;


/**
 * @template T of Data
 */
trait IXApiUpdate
{
    public const UPDATE = 'update';

    /**
     * @param T $modelData
     * @throws RequestException
     * @throws Throwable
     */
    public function update(int|array $id, Data $modelData): void
    {
        $this->call(
            action: static::UPDATE,
            urlParams: is_int($id) ? compact('id') : $id,
            bodyData: [$this->getJsonRootObjectKey() => $modelData]);
    }
}
