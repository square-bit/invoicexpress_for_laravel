<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

/**
 * @template TData of EntityData
 */
trait FindsByCode
{
    public const FIND_BY_CODE = 'find-by-code';

    protected const CLIENT_CODE = 'client_code';

    abstract protected function getEntityType(): EntityTypeEnum;

    /**
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function findByCode(string $code): EntityData
    {
        $data = $this->call(
            action: static::FIND_BY_CODE,
            queryParams: [self::CLIENT_CODE => $code]
        );

        return $this->responseToDataObject($data[$this->getEntityType()->value]);
    }
}
