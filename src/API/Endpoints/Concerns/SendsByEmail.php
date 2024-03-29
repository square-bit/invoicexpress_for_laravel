<?php

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EmailData;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;

trait SendsByEmail
{
    public const SEND_BY_EMAIL = 'send-by-email';

    private const SEND_BY_EMAIL_ROOT_OBJECT_KEY = 'message';

    /**
     * @throws RequestException
     */
    public function sendByEmail(EntityTypeEnum $entityType, int $id, EmailData $data): void
    {
        $this->call(
            action: static::SEND_BY_EMAIL,
            urlParams: [
                'type' => $entityType->toUrlVariable(),
                'id' => $id,
            ],
            bodyData: [self::SEND_BY_EMAIL_ROOT_OBJECT_KEY => $data]
        );
    }
}
