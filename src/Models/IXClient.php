<?php

namespace Squarebit\InvoiceXpress\Models;

/*
 * This is the InvoiceXpress Client.
 * https://invoicexpress.com/api-v2/clients
 */

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\Traits\IXApiCreate;
use Squarebit\InvoiceXpress\Traits\IXApiFindByCode;
use Squarebit\InvoiceXpress\Traits\IXApiFindByName;
use Squarebit\InvoiceXpress\Traits\IXApiGet;
use Squarebit\InvoiceXpress\Traits\IXApiList;
use Squarebit\InvoiceXpress\Traits\IXApiListInvoices;
use Squarebit\InvoiceXpress\Traits\IXApiUpdate;

class IXClient extends IXEntity
{
    use IXApiList;
    use IXApiGet;
    use IXApiCreate;
    use IXApiUpdate;
    use IXApiFindByCode;
    use IXApiFindByName;
    use IXApiListInvoices;

    protected static string $endpointConfig = 'client';
}
