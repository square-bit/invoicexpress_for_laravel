<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Tax.
 * https://invoicexpress.com/api-v2/taxes
 */

use Squarebit\InvoiceXpress\API\Data\TaxData;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\CreatesWithType;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Deletes;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\GetsWithType;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\UpdatesWithType;

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

    /** @uses CreatesWithType<TaxData> */
    use CreatesWithType;

    use Deletes;

    public const ENDPOINT_CONFIG = 'tax';

    protected function getEndpointName(): string
    {
        return self::ENDPOINT_CONFIG;
    }

    protected function responseToDataObject(array $data): TaxData
    {
        return TaxData::from($data);
    }
}
