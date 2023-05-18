<?php

namespace Squarebit\InvoiceXpress\Models;

/*
 * This is the InvoiceXpress Guide.
 * https://invoicexpress.com/api-v2/guides
 */

use Squarebit\InvoiceXpress\Traits\IXApiChangeState;
use Squarebit\InvoiceXpress\Traits\IXApiCreate;
use Squarebit\InvoiceXpress\Traits\IXApiGeneratePDF;
use Squarebit\InvoiceXpress\Traits\IXApiGet;
use Squarebit\InvoiceXpress\Traits\IXApiGetQRCode;
use Squarebit\InvoiceXpress\Traits\IXApiList;
use Squarebit\InvoiceXpress\Traits\IXApiSendByEmail;
use Squarebit\InvoiceXpress\Traits\IXApiUpdate;

class IXGuide extends IXEntity
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
