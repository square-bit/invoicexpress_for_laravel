<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;
use Throwable;

/**
 * @template TData of EntityData
 */
trait CreatesWithType
{
    public const CREATE = 'create';

    /**
     * @param  TData  $data
     * @return TData
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function create(DocumentTypeEnum $documentType, EntityData $data): EntityData
    {
        $response = $this->call(
            action: static::CREATE,
            urlParams: ['type' => $documentType->toUrlVariable()],
            bodyData: [$documentType->value => $data->toArray()]
        );

        return $this->responseToDataObject($response[$documentType->value]);
    }
}
