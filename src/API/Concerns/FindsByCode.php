<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;

trait FindsByCode
{
    public const FIND_BY_CODE = 'find-by-code';

    protected const CLIENT_CODE = 'client_code';

    /**
     * @throws RequestException
     */
    public function findByCode(string $code): ?array
    {
        return $this->call(
            action: static::FIND_BY_CODE,
            queryParams: [self::CLIENT_CODE => $code]
        );
    }
}
