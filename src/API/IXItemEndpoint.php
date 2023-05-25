<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Item.
 * https://invoicexpress.com/api-v2/items
 */

use Squarebit\InvoiceXpress\API\Concerns\IXApiCreate;
use Squarebit\InvoiceXpress\API\Concerns\IXApiDelete;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGet;
use Squarebit\InvoiceXpress\API\Concerns\IXApiList;
use Squarebit\InvoiceXpress\API\Concerns\IXApiUpdate;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;

/**
 * @extends  IXEndpoint<ItemData>
 */
class IXItemEndpoint extends IXEndpoint
{
    /** @uses IXApiList<ItemData> */
    use IXApiList;

    /** @uses IXApiGet<ItemData> */
    use IXApiGet;

    /** @uses IXApiUpdate<ItemData> */
    use IXApiUpdate;

    /** @uses IXApiCreate<ItemData> */
    use IXApiCreate;

    /** @uses IXApiDelete<ItemData> */
    use IXApiDelete;

    public const ENDPOINT_CONFIG = 'item';

    protected const JSON_ROOT_OBJECT_KEY = 'item';

    protected function responseToDataObject(array $data): ItemData
    {
        return ItemData::from($data);
    }

    protected function getEndpointName(): string
    {
        return self::ENDPOINT_CONFIG;
    }

    protected function getJsonRootObjectKey(): string
    {
        return static::JSON_ROOT_OBJECT_KEY;
    }

    protected function getEntityType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::Items;
    }
}
