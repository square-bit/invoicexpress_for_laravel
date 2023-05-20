<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;

trait IXApiFindByName
{
    public const FIND_BY_NAME = 'find-by-name';

    /**
     * @throws RequestException
     */
    public function findByName(int $id, array $data): ?array
    {
        return $this->call(
            action: static::FIND_BY_NAME,
            urlParams: compact('id'),
            bodyData: $data
        );
    }
}
