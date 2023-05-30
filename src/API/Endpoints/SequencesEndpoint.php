<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Sequence.
 * https://invoicexpress.com/api-v2/sequences
 */

use Spatie\LaravelData\Data;
use Squarebit\InvoiceXpress\API\Concerns\Creates;
use Squarebit\InvoiceXpress\API\Concerns\Gets;
use Squarebit\InvoiceXpress\API\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Concerns\Registers;
use Squarebit\InvoiceXpress\API\Concerns\Updates;
use Squarebit\InvoiceXpress\API\Data\SequenceData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

/**
 * @extends  Endpoint<SequenceData>
 */
class SequencesEndpoint extends Endpoint
{
    use Lists;

    /** @uses Gets<SequenceData> */
    use Gets;

    /** @uses Creates<SequenceData> */
    use Creates;

    /** @uses Updates<SequenceData> */
    use Updates;

    use Registers;

    public const ENDPOINT_CONFIG = 'sequence';

    protected function getEndpointName(): string
    {
        return self::ENDPOINT_CONFIG;
    }

    protected function getEntityType(): EntityTypeEnum
    {
        return EntityTypeEnum::Sequence;
    }

    protected function responseToDataObject(array $data): Data
    {
        return SequenceData::from($data);
    }
}
