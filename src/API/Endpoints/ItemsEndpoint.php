<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Item.
 * https://invoicexpress.com/api-v2/items
 */

use Squarebit\InvoiceXpress\API\Data\Filters\ItemListFilter;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\CreatesWithType;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Deletes;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\GetsWithType;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\UpdatesWithType;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

/**
 * @extends  Endpoint<ItemData>
 */
class ItemsEndpoint extends Endpoint
{
    /** @use Lists<ItemListFilter, ItemData> */
    use Lists;

    /** @use GetsWithType<ItemData> */
    use GetsWithType {get as getWithType; }

    /** @use UpdatesWithType<ItemData> */
    use UpdatesWithType {update as updateWithType; }

    /** @use CreatesWithType<ItemData> */
    use CreatesWithType {create as createWithType; }

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

    public function get(int|EntityTypeEnum $entityType, ?int $id = null): ItemData
    {
        return is_int($entityType) // @phpstan-ignore-line
            ? $this->getWithType(EntityTypeEnum::Item, $id)
            : $this->getWithType($entityType, $id);
    }

    public function create(ItemData|EntityTypeEnum $entityType, ?ItemData $data = null): ItemData
    {
        return $entityType instanceof EntityTypeEnum // @phpstan-ignore-line
            ? $this->createWithType($entityType, $data)
            : $this->createWithType(EntityTypeEnum::Item, $entityType);

    }

    public function update(ItemData|EntityTypeEnum $entityType, ?ItemData $data = null): void
    {
        $entityType instanceof EntityTypeEnum
            ? $this->updateWithType($entityType, $data)
            : $this->updateWithType(EntityTypeEnum::Item, $entityType);
    }
}
