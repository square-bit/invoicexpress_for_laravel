<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Estimate.
 * https://invoicexpress.com/api-v2/estimates
 */

use Spatie\LaravelData\Data;
use Squarebit\InvoiceXpress\API\Concerns\IXApiChangeState;
use Squarebit\InvoiceXpress\API\Concerns\IXApiCreate;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGeneratePDF;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGet;
use Squarebit\InvoiceXpress\API\Concerns\IXApiList;
use Squarebit\InvoiceXpress\API\Concerns\IXApiSendByEmail;
use Squarebit\InvoiceXpress\API\Concerns\IXApiUpdate;
use Squarebit\InvoiceXpress\API\Data\EstimateData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;

/**
 * @template-extends IXEndpoint<EstimateData>
 */
 class IXEstimateEndpoint extends IXEndpoint
{
    use IXApiSendByEmail;

    /** @uses IXApiSendByEmail<EstimateData> */
    use IXApiGeneratePDF;

    /** @uses IXApiGet<EstimateData> */
    use IXApiGet;
    use IXApiList;

    /** @uses IXApiCreate<EstimateData> */
    use IXApiCreate;

    /** @uses IXApiUpdate<EstimateData> */
    use IXApiUpdate;
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
