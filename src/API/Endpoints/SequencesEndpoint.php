<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Sequence.
 * https://invoicexpress.com/api-v2/sequences
 */

use Spatie\LaravelData\Data;
use Squarebit\InvoiceXpress\API\Data\Filters\Base\QueryFilter;
use Squarebit\InvoiceXpress\API\Data\SequenceData;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\CreatesWithType;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\GetsWithType;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Registers;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\SetsCurrent;

/**
 * @extends  Endpoint<SequenceData>
 */
class SequencesEndpoint extends Endpoint
{
    /** @use Lists<QueryFilter, SequenceData> */
    use Lists;

    /** @use GetsWithType<SequenceData> */
    use GetsWithType;

    /** @use CreatesWithType<SequenceData> */
    use CreatesWithType;

    use SetsCurrent;

    /** @use Registers<SequenceData> */
    use Registers;

    public const ENDPOINT_CONFIG = 'sequence';

    protected function getEndpointName(): string
    {
        return self::ENDPOINT_CONFIG;
    }

    protected function responseToDataObject(array $data): Data
    {
        return SequenceData::from($data);
    }
}
