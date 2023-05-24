<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Sequence.
 * https://invoicexpress.com/api-v2/sequences
 */

use Squarebit\InvoiceXpress\API\Concerns\IXApiCreate;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGet;
use Squarebit\InvoiceXpress\API\Concerns\IXApiList;
use Squarebit\InvoiceXpress\API\Concerns\IXApiUpdate;

class IXSequenceEndpoint //extends IXEndpoint
{
    use IXApiList;
    use IXApiGet;
    use IXApiCreate;
    use IXApiUpdate;

    protected static string $endpointConfig = 'sequence';

    public const REGISTER = 'register';

    public function register(): array
    {
        return $this->call('register');
    }
}
