<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityListData;
use Throwable;

trait IXApiList
{
    public const LIST = 'list';
    protected const PAGE = 1;
    protected const PER_PAGE = 30;
    protected const PAGINATION_TAG = 'pagination';

    /**
     * @throws RequestException|Throwable
     */
    public function list(int $page = self::PAGE, int $perPage = self::PER_PAGE): EntityListData
    {
        $data = $this->call(
            action: static::LIST,
            queryParams: [
                'page' => $page,
                'per_page' => $perPage,
            ]
        );

        // The response array contains 2 keys: 'pagination' and a variable one depending
        // on the entity being queried. We want this unknown one to be called 'items'
        $pagination = $data[self::PAGINATION_TAG];
        unset($data[self::PAGINATION_TAG]);
        $items = collect($data)
            ->flatten(1)
            ->map(fn ($item) => $this->responseToDataObject($item))
            ->all();

        return EntityListData::from(compact('items', 'pagination'));
    }
}
