<?php

namespace Squarebit\InvoiceXpress\API\Traits;

use Illuminate\Http\Client\RequestException;

trait IXApiList
{
    public const LIST = 'list';

    /**
     * @throws RequestException
     */
    public function list(int $page = 1, int $perPage = 30): ?array
    {
        return $this->call(
            action: static::LIST,
            queryParams: [
                'page' => $page,
                'per_page' => $perPage,
            ]
        );
    }
}
