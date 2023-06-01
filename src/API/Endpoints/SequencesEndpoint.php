<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Sequence.
 * https://invoicexpress.com/api-v2/sequences
 */

use Spatie\LaravelData\Data;
use Squarebit\InvoiceXpress\API\Data\SequenceData;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Creates;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Gets;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Registers;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\SetsCurrent;
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

    use SetsCurrent;
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
