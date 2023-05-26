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

    /** @uses GeneratesPDF<EstimateData> */
    use GeneratesPDF;

    /** @uses GetsWithType<EstimateData> */
    use GetsWithType;

    use Lists;

    /** @uses \Squarebit\InvoiceXpress\API\Concerns\CreatesWithType<EstimateData> */
    use CreatesWithType;

    /** @uses UpdatesWithType<EstimateData> */
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
