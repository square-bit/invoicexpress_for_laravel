<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Client.
 * https://invoicexpress.com/api-v2/clients
 */

use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\CreatesWithType;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Deletes;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\FindsByCode;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\FindsByName;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\GetsWithType;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\ListsInvoices;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\UpdatesWithType;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

/**
 * @template-extends Endpoint<ClientData>
 */
class ClientsEndpoint extends Endpoint
{
    /** @uses Lists<void> */
    use Lists;

    /** @uses GetsWithType<ClientData> */
    use GetsWithType;

    /** @uses CreatesWithType<ClientData> */
    use CreatesWithType;

    /** @uses UpdatesWithType<ClientData> */
    use UpdatesWithType;

    /** @uses FindsByCode<ClientData> */
    use FindsByCode;

    /** @uses FindsByName<ClientData> */
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
