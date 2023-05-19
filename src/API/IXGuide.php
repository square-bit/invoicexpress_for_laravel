<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Guide.
 * https://invoicexpress.com/api-v2/guides
 */

use Squarebit\InvoiceXpress\API\Traits\IXApiChangeState;
use Squarebit\InvoiceXpress\API\Traits\IXApiCreate;
use Squarebit\InvoiceXpress\API\Traits\IXApiGeneratePDF;
use Squarebit\InvoiceXpress\API\Traits\IXApiGet;
use Squarebit\InvoiceXpress\API\Traits\IXApiGetQRCode;
use Squarebit\InvoiceXpress\API\Traits\IXApiList;
use Squarebit\InvoiceXpress\API\Traits\IXApiSendByEmail;
use Squarebit\InvoiceXpress\API\Traits\IXApiUpdate;

class IXGuide extends IXEndpoint
{
    use IXApiSendByEmail;
    use IXApiGeneratePDF;
    use IXApiGet;
    use IXApiList;
    use IXApiCreate;
    use IXApiUpdate;
    use IXApiChangeState;
    use IXApiGetQRCode;

    protected static string $endpointConfig = 'guide';
}
