<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;

trait IXApiDelete
{
    public const DELETE = 'delete';

    /**
     * @throws RequestException
     */
    public function delete(int|array $id): ?array
    {
        return $this->call(
            action: 'delete',
            urlParams: is_int($id) ? compact('id') : $id
        );
    }
}
