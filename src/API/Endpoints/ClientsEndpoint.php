<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Client.
 * https://invoicexpress.com/api-v2/clients
 */

use Squarebit\InvoiceXpress\API\Concerns\Creates;
use Squarebit\InvoiceXpress\API\Concerns\Deletes;
use Squarebit\InvoiceXpress\API\Concerns\FindsByCode;
use Squarebit\InvoiceXpress\API\Concerns\FindsByName;
use Squarebit\InvoiceXpress\API\Concerns\Gets;
use Squarebit\InvoiceXpress\API\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Concerns\ListsInvoices;
use Squarebit\InvoiceXpress\API\Concerns\Updates;
use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

/**
 * @template-extends Endpoint<ClientData>
 */
class ClientsEndpoint extends Endpoint
{
    /** @uses Lists<void> */
    use Lists;

    /** @uses Gets<ClientData> */
    use Gets;

    /** @uses Creates<ClientData> */
    use Creates;

    /** @uses Updates<ClientData> */
    use Updates;

    use FindsByCode;
    use FindsByName;

    /** @uses ListsInvoices<ClientData> */
    use ListsInvoices;

    use Deletes;

    public const ENDPOINT_CONFIG = 'client';

    protected function responseToDataObject(array $data): ClientData
    {
        return ClientData::from($data);
    }

    protected function getEndpointName(): string
    {
        return static::ENDPOINT_CONFIG;
    }

    protected function getEntityType(): EntityTypeEnum
    {
        return EntityTypeEnum::Client;
    }
}
