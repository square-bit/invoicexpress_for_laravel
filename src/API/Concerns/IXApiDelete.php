<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Throwable;

trait IXApiDelete
{
    public const DELETE = 'delete';

    /**
     * @throws RequestException|Throwable
     */
    public function delete(int $id): void
    {
        $this->call(
            action: static::DELETE,
            urlParams: compact('id')
        );
    }
}
