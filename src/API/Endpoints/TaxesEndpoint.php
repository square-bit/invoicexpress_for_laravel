<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Tax.
 * https://invoicexpress.com/api-v2/taxes
 */

use Squarebit\InvoiceXpress\API\Concerns\Creates;
use Squarebit\InvoiceXpress\API\Concerns\Deletes;
use Squarebit\InvoiceXpress\API\Concerns\GetsWithType;
use Squarebit\InvoiceXpress\API\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Concerns\UpdatesWithType;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Data\TaxData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

/**
 * @template-extends Endpoint<TaxData>
 */
class TaxesEndpoint extends Endpoint
{
    use Lists;

    /** @uses GetsWithType<TaxData> */
    use GetsWithType;

    /** @uses UpdatesWithType<TaxData> */
    use UpdatesWithType;

    /** @uses Creates<TaxData> */
    use Creates;

    use Deletes;

    public const ENDPOINT_CONFIG = 'tax';

    protected function getEndpointName(): string
    {
        return self::ENDPOINT_CONFIG;
    }

    protected function getEntityType(): EntityTypeEnum
    {
        return EntityTypeEnum::Tax;
    }

    protected function responseToDataObject(array $data): ItemData
    {
        return ItemData::from($data);
    }
}
