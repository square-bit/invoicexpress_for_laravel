<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;

trait ListsInvoices
{
    public const LIST_INVOICES = 'list-invoices';

    /**
     * @throws RequestException
     */
    public function listInvoices(int $id): ?array
    {
        return $this->call(
            action: static::LIST_INVOICES,
            urlParams: ['id' => $id],
        );
    }
}
