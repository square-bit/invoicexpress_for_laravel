<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Item.
 * https://invoicexpress.com/api-v2/items
 */

use Squarebit\InvoiceXpress\API\Concerns\Creates;
use Squarebit\InvoiceXpress\API\Concerns\Deletes;
use Squarebit\InvoiceXpress\API\Concerns\Gets;
use Squarebit\InvoiceXpress\API\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Concerns\Updates;
use Squarebit\InvoiceXpress\API\Data\Filters\ItemListFilter;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

/**
 * @extends  Endpoint<ItemData>
 */
class ItemsEndpoint extends Endpoint
{
    /** @uses Lists<ItemListFilter> */
    use Lists;

    /** @uses Gets<ItemData> */
    use Gets;

    /** @uses Updates<ItemData> */
    use Updates;

    /** @uses Creates<ItemData> */
    use Creates;

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

    protected function getEntityType(): EntityTypeEnum
    {
        return EntityTypeEnum::Item;
    }
}
