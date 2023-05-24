<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Estimate.
 * https://invoicexpress.com/api-v2/estimates
 */

use Squarebit\InvoiceXpress\API\Concerns\IXApiChangeState;
use Squarebit\InvoiceXpress\API\Concerns\IXApiCreate;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGeneratePDF;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGet;
use Squarebit\InvoiceXpress\API\Concerns\IXApiList;
use Squarebit\InvoiceXpress\API\Concerns\IXApiSendByEmail;
use Squarebit\InvoiceXpress\API\Concerns\IXApiUpdate;

class IXEstimateEndpoint //extends IXEndpoint
{
    use IXApiSendByEmail;
    use IXApiGeneratePDF;
    use IXApiGet;
    use IXApiList;
    use IXApiCreate;
    use IXApiUpdate;
    use IXApiChangeState;

    protected static string $endpointConfig = 'estimate';
}
