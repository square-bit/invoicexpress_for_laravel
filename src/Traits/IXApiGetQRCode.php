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
            action: 'get-qrcode',
            urlParams: compact('id')
        );
    }
}
