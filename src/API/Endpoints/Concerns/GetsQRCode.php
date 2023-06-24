<?php

namespace Squarebit\InvoiceXpress\API\Endpoints\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\QRCodeData;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

trait GetsQRCode
{
    public const GET_QRCODE = 'get-qrcode';

    private const QR_CODE_ROOT_OBJECT_KEY = 'qr_code';

    /**
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function getQRCode(int $id): QRCodeData
    {
        $data = $this->call(
            action: static::GET_QRCODE,
            urlParams: compact('id')
        );

        return QRCodeData::from($data[self::QR_CODE_ROOT_OBJECT_KEY]);
    }
}
