<?php

namespace Squarebit\InvoiceXpress\Models;

/*
 * This is the InvoiceXpress Client.
 * https://invoicexpress.com/api-v2/clients
 */

use Squarebit\InvoiceXpress\Traits\IXApiCreate;
use Squarebit\InvoiceXpress\Traits\IXApiGet;
use Squarebit\InvoiceXpress\Traits\IXApiList;
use Squarebit\InvoiceXpress\Traits\IXApiUpdate;

class IXClient extends IXEntity
{
    use IXApiList;
    use IXApiGet;
    use IXApiCreate;
    use IXApiUpdate;

    protected static string $endpointConfig = 'client';
    public const FIND_BY_NAME = 'find-by-name';
    public const LIST_INVOICES = 'list-invoices';

    public function findByName(string $name): ?array
    {
        return $this->call(
            action: 'find-by-name',
            queryParams: ['client_name' => $name]
        );
    }

    public function listInvoices(int $id): ?array
    {
        return $this->call(
            action: 'list-invoices',
            urlParams: ['id' => $id],
        );
    }
}
