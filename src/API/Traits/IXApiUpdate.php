<?php

namespace Squarebit\InvoiceXpress\API\Traits;

use Illuminate\Http\Client\RequestException;

trait IXApiUpdate
{
    public const UPDATE = 'update';

    /**
     * @throws RequestException
     */
    public function update(int | array $id, array $data = []): void
    {
        $this->call(
            action: static::UPDATE,
            urlParams: is_int($id) ? compact('id') : $id,
            bodyData: $data);
    }
}
