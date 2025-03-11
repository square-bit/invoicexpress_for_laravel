<?php

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

/**
 * @template T of EntityData
 */
trait CreatesWithType
{
    public const CREATE = 'create';

    /**
     * @param  T  $data
     * @return T
     *
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function create(EntityTypeEnum $entityType, EntityData $data): EntityData
    {
        $data = [$entityType->value => $data->toCreateData()->toArray()];
        return $this->callApi($entityType, $data);
    }

    public function callApi(EntityTypeEnum $entityType, array $data): EntityData{
        $response = $this->call(
            action: static::CREATE,
            urlParams: ['type' => $entityType->toUrlVariable()],
            bodyData: $data
        );
        return $this->responseToDataObject($response[$entityType->value]);
    }
}
