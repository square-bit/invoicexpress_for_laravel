<?php

namespace Squarebit\InvoiceXpress\Models;

/*
 * This is the InvoiceXpress Tax.
 * https://invoicexpress.com/api-v2/taxes
 */

use Squarebit\InvoiceXpress\Traits\IXApiCreate;
use Squarebit\InvoiceXpress\Traits\IXApiDelete;
use Squarebit\InvoiceXpress\Traits\IXApiGet;
use Squarebit\InvoiceXpress\Traits\IXApiList;
use Squarebit\InvoiceXpress\Traits\IXApiUpdate;

class IXTax extends IXEntity
{
    use IXApiList;
    use IXApiGet;
    use IXApiUpdate;
    use IXApiCreate;
    use IXApiDelete;

    protected static string $endpointConfig = 'tax';
}
