<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Estimate.
 * https://invoicexpress.com/api-v2/estimates
 */

use Spatie\LaravelData\Data;
use Squarebit\InvoiceXpress\API\Concerns\ChangesState;
use Squarebit\InvoiceXpress\API\Concerns\CreatesWithType;
use Squarebit\InvoiceXpress\API\Concerns\GeneratesPDF;
use Squarebit\InvoiceXpress\API\Concerns\GetsWithType;
use Squarebit\InvoiceXpress\API\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Concerns\SendsByEmail;
use Squarebit\InvoiceXpress\API\Concerns\UpdatesWithType;
use Squarebit\InvoiceXpress\API\Data\EstimateData;

/**
 * @template-extends Endpoint<EstimateData>
 */
class EstimatesEndpoint extends Endpoint
{
    use SendsByEmail;

    /** @uses IXApiSendByEmail<EstimateData> */
    use GeneratesPDF;

    /** @uses IXApiGetWithType<EstimateData> */
    use GetsWithType;

    use Lists;

    /** @uses IXApiCreateWithType<EstimateData> */
    use CreatesWithType;

    /** @uses IXApiUpdateWithType<EstimateData> */
    use UpdatesWithType;

    use ChangesState;

    public const ENDPOINT_CONFIG = 'estimate';

    protected function responseToDataObject(array $data): Data
    {
        return EstimateData::from($data);
    }

    protected function getEndpointName(): string
    {
        return static::ENDPOINT_CONFIG;
    }
}
