<?php

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Throwable;

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
