<?php

namespace Squarebit\InvoiceXpress\Concerns;

use Squarebit\InvoiceXpress\API\Data\QRCodeData;

trait GetsQrCode
{
    public function getQrCode(): ?QRCodeData
    {
        return $this->getEndpoint()
            ->getQRCode($this->id);
    }
}
