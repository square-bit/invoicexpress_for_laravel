<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Saft.
 * https://invoicexpress.com/api-v2/saf-t
 */

use Spatie\LaravelData\Data;
use Squarebit\InvoiceXpress\API\Concerns\Gets;
use Squarebit\InvoiceXpress\API\Concerns\GetsWithType;
use Squarebit\InvoiceXpress\API\Data\SaftData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

/**
 * @extends  Endpoint<SaftData>
 */
class SaftEndpoint extends Endpoint
{
    /** @uses Gets<SaftData */
    use Gets;

    public const ENDPOINT_CONFIG = 'saft';

    protected function responseToDataObject(array $data): SaftData
    {
        return SaftData::from($data);
    }

    protected function getEndpointName(): string
    {
        return self::ENDPOINT_CONFIG;
    }

    protected function getEntityType(): EntityTypeEnum
    {
        return EntityTypeEnum::Saft;
    }
}
