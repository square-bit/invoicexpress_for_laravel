<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Throwable;

/**
 * @template T of EntityData
 */
trait SetsCurrent
{
    public const SET_CURRENT = 'set_current';

    /**
     * @throws RequestException
     * @throws Throwable
     */
    public function setCurrent(int $id): void
    {
        $this->call(
            action: static::SET_CURRENT,
            urlParams: compact('id')
        );
    }
}
