<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

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
            action: static::GENERATE_PAYMENT,
            urlParams: compact('id'),
            bodyData: $data
        );
    }
}
