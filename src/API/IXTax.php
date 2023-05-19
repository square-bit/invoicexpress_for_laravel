<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Tax.
 * https://invoicexpress.com/api-v2/taxes
 */

use Squarebit\InvoiceXpress\API\Traits\IXApiCreate;
use Squarebit\InvoiceXpress\API\Traits\IXApiDelete;
use Squarebit\InvoiceXpress\API\Traits\IXApiGet;
use Squarebit\InvoiceXpress\API\Traits\IXApiList;
use Squarebit\InvoiceXpress\API\Traits\IXApiUpdate;

class IXTax extends IXEndpoint
{
    use IXApiList;
    use IXApiGet;
    use IXApiUpdate;
    use IXApiCreate;
    use IXApiDelete;

    protected static string $endpointConfig = 'tax';
}
