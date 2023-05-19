<?php

namespace Squarebit\InvoiceXpress\Traits;

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
            action: 'get',
            urlParams: is_int($id) ? compact('id') : $id
        );
    }
}
