<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EmailData;

trait SendsByEmail
{
    public const SEND_BY_EMAIL = 'send-by-email';

    private const SEND_BY_EMAIL_ROOT_OBJECT_KEY = 'message';

    /**
     * @throws RequestException
     */
    public function sendByEmail(int $id, EmailData $data): void
    {
        $this->call(
            action: static::SEND_BY_EMAIL,
            urlParams: compact('id'),
            bodyData: [self::SEND_BY_EMAIL_ROOT_OBJECT_KEY => $data]
        );
    }
}