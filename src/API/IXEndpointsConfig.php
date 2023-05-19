<?php

namespace Squarebit\InvoiceXpress\API;

use Illuminate\Support\Arr;

class IXEndpointsConfig
{
    protected static ?array $endpoints;

    public static function get(?string $data = null): null | string | int | array
    {
        static::$endpoints ??= config('ix-endpoints');

        return Arr::get(static::$endpoints, $data);
    }
}
