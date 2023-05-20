<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;

trait IXApiGet
{
    public const GET = 'get';

    /**
     * @throws RequestException
     */
    public function get(int|array $id): ?array
    {
        return $this->call(
            action: static::GET,
            urlParams: is_int($id) ? compact('id') : $id
        );
    }
}
