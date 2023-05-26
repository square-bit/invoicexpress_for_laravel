<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;
use Throwable;

/**
 * @template TData of EntityData
 */
trait IXApiGet
{
    public const GET = 'get';

    /**
     * @return TData
     *
     * @throws RequestException
     * @throws Throwable
     */
    public function get(DocumentTypeEnum $documentType, int $id): EntityData
    {
        $data = $this->call(
            action: static::GET,
            urlParams: [
                'type' => $this->documentTypeToUrlVariable($documentType),
                'id' => $id,
            ],
        );

        return $this->responseToDataObject($data[$documentType->value]);
    }
}
