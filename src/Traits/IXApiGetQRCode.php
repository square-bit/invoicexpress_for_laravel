<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;

trait IXApiGetQRCode
{
    public const GET_QRCODE = 'get-qrcode';

    /**
     * @throws RequestException
     */
    public function getQRCode(int $id): ?array
    {
        return $this->call(
            action: static::GET_QRCODE,
            urlParams: compact('id')
        );
    }
}
