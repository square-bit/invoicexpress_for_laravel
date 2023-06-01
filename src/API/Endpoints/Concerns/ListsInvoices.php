<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\PaginationFilter;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

trait ListsInvoices
{
    public const LIST_INVOICES = 'list-invoices';

    /**
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function listInvoices(int $clientId, ?PaginationFilter $filter = null): EntityListData
    {

        $data = $this->call(
            action: static::LIST_INVOICES,
            urlParams: ['id' => $clientId],
            queryParams: $filter?->toArray() ?? []
        );

        // The response array contains 2 keys: 'pagination' and a variable one depending
        // on the entity being queried. We want this unknown one to be called 'items'
        $pagination = $data[self::PAGINATION_TAG];
        unset($data[self::PAGINATION_TAG]);
        $items = collect($data)
            ->flatten(1)
            ->map(fn ($item) => InvoiceData::from($item))
            ->all();

        return EntityListData::from(compact('items', 'pagination'));
    }
}
