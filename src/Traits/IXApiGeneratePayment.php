<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;

trait IXApiGeneratePayment
{
    public const GENERATE_PAYMENT = 'generate-payment';

    /**
     * @throws RequestException
     */
    public function generatePayment(int $id, array $data): ?array
    {
        return $this->call(
            action: 'generate-payment',
            urlParams: compact('id'),
            bodyData: $data
        );
    }
}
