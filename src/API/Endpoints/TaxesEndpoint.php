<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Tax.
 * https://invoicexpress.com/api-v2/taxes
 */

use Squarebit\InvoiceXpress\API\Data\TaxData;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Creates;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Deletes;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Gets;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Updates;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

/**
 * @template-extends Endpoint<TaxData>
 */
class TaxesEndpoint extends Endpoint
{
    use Lists;

    /** @uses Gets<TaxData> */
    use Gets;

    /** @uses Updates<TaxData> */
    use Updates;

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

    protected function responseToDataObject(array $data): TaxData
    {
        return TaxData::from($data);
    }
}
