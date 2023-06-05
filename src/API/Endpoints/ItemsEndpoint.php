<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Item.
 * https://invoicexpress.com/api-v2/items
 */

use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\CreatesWithType;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Deletes;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\GetsWithType;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\UpdatesWithType;

/**
 * @extends  Endpoint<ItemData>
 */
class ItemsEndpoint extends Endpoint
{
    /** @uses Lists<ItemListFilter> */
    use Lists;

    /** @uses GetsWithType<ItemData> */
    use GetsWithType;

    /** @uses UpdatesWithType<ItemData> */
    use UpdatesWithType;

    /** @uses CreatesWithType<ItemData> */
    use CreatesWithType;

    /** @uses IXApiDelete<ItemData> */
    use Deletes;

    public const ENDPOINT_CONFIG = 'item';

    protected function getEndpointName(): string
    {
        return self::ENDPOINT_CONFIG;
    }

    protected function responseToDataObject(array $data): ItemData
    {
        return ItemData::from($data);
    }
}
