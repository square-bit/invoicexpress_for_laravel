<?php

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;
use Throwable;

/**
 * @template T of EntityData
 */
trait GetsWithType
{
    public const GET = 'get';

    /**
     * @return T
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function get(EntityTypeEnum $entityType, int $id): EntityData
    {
        $data = $this->call(
            action: static::GET,
            urlParams: [
                'type' => $entityType->toUrlVariable(),
                'id' => $id,
            ],
        );

        return $this->responseToDataObject($data[$entityType->value]);
    }
}
