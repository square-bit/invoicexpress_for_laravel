<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

trait IXApiGetRelatedDocuments
{
    public const RELATED_DOCUMENTS = 'related-documents';

    /**
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function getRelatedDocuments(int $id): EntityListData
    {
        $response = $this->call(
            action: static::RELATED_DOCUMENTS,
            urlParams: compact('id')
        );

        $items = collect($response)
            ->flatten(1)
            ->map(fn ($item) => $this->responseToDataObject($item))
            ->all();

        return EntityListData::from(compact('items'));
    }
}
