<?php

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\QueryFilter;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

/**
 * @template Q of ?QueryFilter
 * @template T of EntityData
 */
trait Lists
{
    public const LIST = 'list';

    protected const PAGINATION_TAG = 'pagination';

    /**
     * @param  Q|null  $filter
     * @return EntityListData<T>
     *
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function list(?QueryFilter $filter = null): EntityListData
    {
        $data = $this->call(
            action: static::LIST,
            queryParams: $filter?->toArray() ?? [],
        );

        return $this->handleListResponse($data);
    }

    /**
     * @return EntityListData<T>
     */
    protected function handleListResponse(array $response): EntityListData
    {
        // The response array contains 2 keys: 'pagination' and a variable one depending
        // on the entity being queried. We want this unknown one to be called 'items'
        $pagination = $response[self::PAGINATION_TAG] ?? null;
        unset($response[self::PAGINATION_TAG]);
        $items = collect($response)
            ->flatten(1)
            ->map(fn ($item) => $this->responseToDataObject($item))
            ->all();

        return $pagination
            ? EntityListData::from(compact('items', 'pagination'))
            : EntityListData::from(compact('items'));
    }
}
