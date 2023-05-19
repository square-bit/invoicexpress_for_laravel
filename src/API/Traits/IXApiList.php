<?php

namespace Squarebit\InvoiceXpress\API\Traits;

use Illuminate\Http\Client\RequestException;

trait IXApiList
{
    public const LIST = 'list';

    /**
     * @throws RequestException
     */
    public function list(array $queryParams = []): ?array
    {
        return $this->call(
            action: static::LIST,
            queryParams: $queryParams
        );
    }
}
