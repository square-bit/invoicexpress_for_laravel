<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Guide.
 * https://invoicexpress.com/api-v2/guides
 */

use Squarebit\InvoiceXpress\API\Concerns\ChangesState;
use Squarebit\InvoiceXpress\API\Concerns\CreatesWithType;
use Squarebit\InvoiceXpress\API\Concerns\GeneratesPDF;
use Squarebit\InvoiceXpress\API\Concerns\GetsQRCode;
use Squarebit\InvoiceXpress\API\Concerns\GetsWithType;
use Squarebit\InvoiceXpress\API\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Concerns\SendsByEmail;
use Squarebit\InvoiceXpress\API\Concerns\UpdatesWithType;

class GuidesEndpoint //extends IXEndpoint
{
    use SendsByEmail;
    use GeneratesPDF;
    use GetsWithType;
    use Lists;
    use CreatesWithType;
    use UpdatesWithType;
    use ChangesState;
    use GetsQRCode;

    protected static string $endpointConfig = 'guide';
}
