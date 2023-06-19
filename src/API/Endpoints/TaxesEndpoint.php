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
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

/**
 * @template-extends Endpoint<TaxData>
 */
class TaxesEndpoint extends Endpoint
{
    use Lists;

    /** @uses GetsWithType<TaxData> */
    use GetsWithType {get as getWithType; }

    /** @uses UpdatesWithType<TaxData> */
    use UpdatesWithType {update as updateWithType; }

    /** @uses CreatesWithType<TaxData> */
    use CreatesWithType {create as createWithType; }

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

    public function get(int|EntityTypeEnum $entityType, ?int $id = null): TaxData
    {
        return $id
            ? $this->getWithType($entityType, $id)
            : $this->getWithType(EntityTypeEnum::Tax, $id);
    }

    public function create(TaxData|EntityTypeEnum $entityType, ?TaxData $data = null): TaxData
    {
        return $data
            ? $this->createWithType($entityType, $data)
            : $this->createWithType(EntityTypeEnum::Tax, $entityType);

    }

    public function update(TaxData|EntityTypeEnum $entityType, ?TaxData $data = null): void
    {
        $data
            ? $this->updateWithType($entityType, $data)
            : $this->updateWithType(EntityTypeEnum::Tax, $entityType);
    }
}
