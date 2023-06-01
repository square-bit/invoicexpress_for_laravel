<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Throwable;

trait Deletes
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
