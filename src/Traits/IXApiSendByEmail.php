<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\Enums\InvoiceTypeEnum;

trait IXApiSendByEmail
{
    public const SEND_BY_EMAIL = 'send-by-email';

    /**
     * @throws RequestException
     */
    public function sendByEmail(InvoiceTypeEnum $type, int $id): array
    {
        return $this->call(
            action: 'send-by-email',
            urlParams: [
                'type' => $type->value,
                'id' => $id,
            ]);
    }
}
