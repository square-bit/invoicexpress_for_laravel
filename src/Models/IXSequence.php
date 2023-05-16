<?php

namespace Squarebit\InvoiceXpress\Models;

/*
 * This is the InvoiceXpress Sequence.
 * https://invoicexpress.com/api-v2/sequences
 */

use Squarebit\InvoiceXpress\Traits\IXApiCreate;
use Squarebit\InvoiceXpress\Traits\IXApiGet;
use Squarebit\InvoiceXpress\Traits\IXApiList;
use Squarebit\InvoiceXpress\Traits\IXApiUpdate;

class IXSequence extends IXEntity
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
