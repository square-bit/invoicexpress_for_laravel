<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

trait FindsByName
{
    public const FIND_BY_NAME = 'find-by-name';

    protected const CLIENT_NAME = 'client_name';

    abstract protected function getEntityType(): EntityTypeEnum;

    /**
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function findByName(string $name): EntityData
    {
        $data = $this->call(
            action: static::FIND_BY_NAME,
            queryParams: [self::CLIENT_NAME => $name]
        );

        return $this->responseToDataObject($data[$this->getEntityType()->value]);
    }
}
