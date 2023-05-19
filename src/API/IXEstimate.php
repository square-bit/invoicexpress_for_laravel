<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Estimate.
 * https://invoicexpress.com/api-v2/estimates
 */

use Squarebit\InvoiceXpress\API\Traits\IXApiChangeState;
use Squarebit\InvoiceXpress\API\Traits\IXApiCreate;
use Squarebit\InvoiceXpress\API\Traits\IXApiGeneratePDF;
use Squarebit\InvoiceXpress\API\Traits\IXApiGet;
use Squarebit\InvoiceXpress\API\Traits\IXApiList;
use Squarebit\InvoiceXpress\API\Traits\IXApiSendByEmail;
use Squarebit\InvoiceXpress\API\Traits\IXApiUpdate;

class IXEstimate extends IXEndpoint
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
