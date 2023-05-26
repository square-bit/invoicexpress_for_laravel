<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Throwable;

/**
 * @template T of EntityData
 */
trait IXApiUpdate
{
    public const UPDATE = 'update';

    /**
     * @param  T  $data
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function update(int $id, EntityData $data): void
    {
        $this->call(
            action: static::UPDATE,
            urlParams: compact('id'),
            bodyData: [$this->getJsonRootObjectKey() => $data->toArray()]);
    }
}
