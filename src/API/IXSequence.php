<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Sequence.
 * https://invoicexpress.com/api-v2/sequences
 */

use Squarebit\InvoiceXpress\API\Traits\IXApiCreate;
use Squarebit\InvoiceXpress\API\Traits\IXApiGet;
use Squarebit\InvoiceXpress\API\Traits\IXApiList;
use Squarebit\InvoiceXpress\API\Traits\IXApiUpdate;

class IXSequence extends IXEndpoint
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
