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
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;

/**
 * @extends  Endpoint<ItemData>
 */
class ItemsEndpoint extends Endpoint
{
    /** @uses IXApiList<ItemData> */
    use Lists;

    /** @uses IXApiGet<ItemData> */
    use Gets;

    /** @uses IXApiUpdate<ItemData> */
    use Updates;

    /** @uses IXApiCreate<ItemData> */
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

    protected function getDocumentType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::Item;
    }
}
