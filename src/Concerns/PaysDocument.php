<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Concerns;

use Illuminate\Support\Carbon;
use Squarebit\InvoiceXpress\API\Data\PartialPaymentData;
use Squarebit\InvoiceXpress\API\Enums\PaymentMechanismEnum;
use Squarebit\InvoiceXpress\Models\IxReceipt;

trait PaysDocument
{
    public function pay(?float $amount = null, ?Carbon $date = null, ?PaymentMechanismEnum $mechanism = null): IxReceipt
    {
        $amount ??= $this->total;

        $receiptData = $this->getEndpoint()->generatePayment(
            $this->getEntityType(),
            $this->id,
            PartialPaymentData::of($amount, $date ?? now(), $mechanism)
        );

        return (new IxReceipt())->fromData($receiptData);
    }
}
