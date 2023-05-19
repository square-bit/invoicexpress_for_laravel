<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;

trait IXApiUpdate
{
    public const UPDATE = 'update';

    /**
     * @throws RequestException
     */
    public function update(int|array $id, array $data = []): void
    {
        $this->call(
            action: 'update',
            urlParams: is_int($id) ? compact('id') : $id,
            bodyData: $data);
    }
}
