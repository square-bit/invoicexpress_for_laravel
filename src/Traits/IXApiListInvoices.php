<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;

trait IXApiListInvoices
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
