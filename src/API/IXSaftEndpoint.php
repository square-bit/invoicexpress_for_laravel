<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Saft.
 * https://invoicexpress.com/api-v2/saf-t
 */

use Squarebit\InvoiceXpress\API\Concerns\IXApiGetWithType;

class IXSaftEndpoint //extends IXEndpoint
{
    use IXApiGetWithType;

    protected static string $endpointConfig = 'saft';
}
