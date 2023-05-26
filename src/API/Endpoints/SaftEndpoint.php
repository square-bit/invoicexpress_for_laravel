<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Saft.
 * https://invoicexpress.com/api-v2/saf-t
 */

use Squarebit\InvoiceXpress\API\Concerns\GetsWithType;

class SaftEndpoint //extends IXEndpoint
{
    use GetsWithType;

    protected static string $endpointConfig = 'saft';
}
