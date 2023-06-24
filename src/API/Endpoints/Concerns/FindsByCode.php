<?php

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

/**
 * @template T of EntityData
 */
trait FindsByCode
{
    public const FIND_BY_CODE = 'find-by-code';

    protected const CLIENT_CODE = 'client_code';

    abstract protected function getEntityType(): EntityTypeEnum;

    /**
     * @return T
     *
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
