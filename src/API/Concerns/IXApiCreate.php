<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;
use Throwable;

/**
 * @template TData of EntityData
 */
trait IXApiCreate
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
            urlParams: ['type' => $this->documentTypeToUrlVariable($documentType)],
            bodyData: [$documentType->value => $data->toArray()]
        );

        return $this->responseToDataObject($response[$documentType->value]);
    }
}
