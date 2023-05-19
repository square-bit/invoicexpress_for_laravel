<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;

trait IXApiCreate
{
    public const CREATE = 'create';

    /**
     * @throws RequestException
     */
    public function create(array $data): array
    {
        return $this->call(
            action: static::CREATE,
            bodyData: $data);
    }
}
