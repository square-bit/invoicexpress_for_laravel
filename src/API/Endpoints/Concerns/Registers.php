<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

/**
 * @template T of EntityData
 */
trait Registers
{
    public const REGISTER = 'register';

    /**
     * @return EntityListData<T>
     *
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function register(int $id): EntityListData
    {
        $response = $this->call(
            action: static::REGISTER,
            urlParams: compact('id')
        );

        return $this->handleListResponse($response);
    }
}
