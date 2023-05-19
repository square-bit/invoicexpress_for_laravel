<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;

trait IXApiCancelPayment
{
    public const CANCEL_PAYMENT = 'cancel-payment';

    /**
     * @throws RequestException
     */
    public function cancelPayment(int $id, array $data): ?array
    {
        return $this->call(
            action: 'cancel-payment',
            urlParams: compact('id'),
            bodyData: $data
        );
    }
}
