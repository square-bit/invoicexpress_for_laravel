<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Guide.
 * https://invoicexpress.com/api-v2/guides
 */

use Squarebit\InvoiceXpress\API\Concerns\IXApiChangeState;
use Squarebit\InvoiceXpress\API\Concerns\IXApiCreateWithType;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGeneratePDF;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGetQRCode;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGetWithType;
use Squarebit\InvoiceXpress\API\Concerns\IXApiList;
use Squarebit\InvoiceXpress\API\Concerns\IXApiSendByEmail;
use Squarebit\InvoiceXpress\API\Concerns\IXApiUpdateWithType;

class IXGuideEndpoint //extends IXEndpoint
{
    use IXApiSendByEmail;
    use IXApiGeneratePDF;
    use IXApiGetWithType;
    use IXApiList;
    use IXApiCreateWithType;
    use IXApiUpdateWithType;
    use IXApiChangeState;
    use IXApiGetQRCode;

    protected static string $endpointConfig = 'guide';
}
