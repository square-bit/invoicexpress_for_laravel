<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Saft.
 * https://invoicexpress.com/api-v2/saf-t
 */

use Squarebit\InvoiceXpress\API\Concerns\IXApiGet;

class IXSaftEndpoint //extends IXEndpoint
{
    use IXApiGet;

    protected static string $endpointConfig = 'saft';
}
