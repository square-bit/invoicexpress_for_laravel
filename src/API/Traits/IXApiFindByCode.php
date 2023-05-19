<?php

namespace Squarebit\InvoiceXpress\API\Traits;

use Illuminate\Http\Client\RequestException;

trait IXApiFindByCode
{
    public const FIND_BY_CODE = 'find-by-code';

    /**
     * @throws RequestException
     */
    public function findByCode(int $id, array $data): ?array
    {
        return $this->call(
            action: static::FIND_BY_CODE,
            urlParams: compact('id'),
            bodyData: $data
        );
    }
}
