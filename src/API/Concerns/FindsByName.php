<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;

trait FindsByName
{
    public const FIND_BY_NAME = 'find-by-name';

    /**
     * @throws RequestException
     */
    public function findByName(string $name): ?array
    {
        return $this->call(
            action: static::FIND_BY_NAME,
            queryParams: ['client_name' => $name]
        );
    }
}
