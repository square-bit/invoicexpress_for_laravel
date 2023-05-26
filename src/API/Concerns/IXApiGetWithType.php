<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;
use Throwable;

/**
 * @template TData of EntityData
 */
trait IXApiGetWithType
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
                'type' => $documentType->toUrlVariable(),
                'id' => $id,
            ],
        );
        dd($data);

        return $this->responseToDataObject($data[$documentType->value]);
    }
}
