<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EmailData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

trait SendsByEmail
{
    public const SEND_BY_EMAIL = 'send-by-email';

    private const SEND_BY_EMAIL_ROOT_OBJECT_KEY = 'message';

    /**
     * @throws RequestException
     */
    public function sendByEmail(EntityTypeEnum $documentType, int $id, EmailData $data): void
    {
        $this->call(
            action: static::SEND_BY_EMAIL,
            urlParams: [
                'type' => $documentType->toUrlVariable(),
                'id' => $id,
            ],
            bodyData: [self::SEND_BY_EMAIL_ROOT_OBJECT_KEY => $data]
        );
    }
}
