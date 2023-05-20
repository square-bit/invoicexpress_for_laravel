<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

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
            action: static::CANCEL_PAYMENT,
            urlParams: compact('id'),
            bodyData: $data
        );
    }
}
