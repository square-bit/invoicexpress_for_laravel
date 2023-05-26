<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Estimate.
 * https://invoicexpress.com/api-v2/estimates
 */

use Spatie\LaravelData\Data;
use Squarebit\InvoiceXpress\API\Concerns\IXApiChangeState;
use Squarebit\InvoiceXpress\API\Concerns\IXApiCreateWithType;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGeneratePDF;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGetWithType;
use Squarebit\InvoiceXpress\API\Concerns\IXApiList;
use Squarebit\InvoiceXpress\API\Concerns\IXApiSendByEmail;
use Squarebit\InvoiceXpress\API\Concerns\IXApiUpdateWithType;
use Squarebit\InvoiceXpress\API\Data\EstimateData;

/**
 * @template-extends IXEndpoint<EstimateData>
 */
class IXEstimateEndpoint extends IXEndpoint
{
    use IXApiSendByEmail;

    /** @uses IXApiSendByEmail<EstimateData> */
    use IXApiGeneratePDF;

    /** @uses IXApiGetWithType<EstimateData> */
    use IXApiGetWithType;

    use IXApiList;

    /** @uses IXApiCreateWithType<EstimateData> */
    use IXApiCreateWithType;

    /** @uses IXApiUpdateWithType<EstimateData> */
    use IXApiUpdateWithType;

    use IXApiChangeState;

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
