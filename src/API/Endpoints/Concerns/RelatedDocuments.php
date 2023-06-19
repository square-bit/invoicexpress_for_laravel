<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

/**
 * @template T of EntityData
 */
trait RelatedDocuments
{
    public const RELATED_DOCUMENTS = 'related-documents';

    /**
     * @return EntityListData<T>
     *
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
