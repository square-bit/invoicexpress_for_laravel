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
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

/**
 * @template-extends Endpoint<ClientData>
 */
class ClientsEndpoint extends Endpoint
{
    /** @use Lists<null, ClientData> */
    use Lists;

    /** @use GetsWithType<ClientData> */
    use GetsWithType {get as getWithType; }

    /** @use CreatesWithType<ClientData> */
    use CreatesWithType {create as createWithType; }

    /** @use UpdatesWithType<ClientData> */
    use UpdatesWithType {update as updateWithType; }

    /** @use FindsByCode<ClientData> */
    use FindsByCode;

    /** @use FindsByName<ClientData> */
    use FindsByName;

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

    /**
     * @throws \Illuminate\Http\Client\RequestException
     * @throws \Throwable
     */
    public function get(int|EntityTypeEnum $entityType, ?int $id = null): ClientData
    {
        return is_int($entityType) // @phpstan-ignore-line
            ? $this->getWithType($this->getEntityType(), $entityType)
            : $this->getWithType($entityType, $id);
    }

    /**
     * @param  ($entityType is ClientData ? null : ClientData)  $data
     *
     * @throws \Illuminate\Http\Client\RequestException
     * @throws \Throwable
     */
    public function create(ClientData|EntityTypeEnum $entityType, ?ClientData $data = null): ClientData
    {
        return $entityType instanceof EntityTypeEnum // @phpstan-ignore-line
            ? $this->createWithType($entityType, $data)
            : $this->createWithType($this->getEntityType(), $entityType);

    }

    public function update(ClientData|EntityTypeEnum $entityType, ?ClientData $data = null): void
    {
        $entityType instanceof EntityTypeEnum
            ? $this->updateWithType($entityType, $data)
            : $this->updateWithType($this->getEntityType(), $entityType);
    }
}
