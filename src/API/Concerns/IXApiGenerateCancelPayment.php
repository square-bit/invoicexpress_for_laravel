<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Exception;
use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Data\PartialPaymentData;
use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;
use Squarebit\InvoiceXpress\API\IXInvoiceEndpoint;
use Squarebit\InvoiceXpress\API\IXReceiptEndpoint;
use Squarebit\InvoiceXpress\API\IXSimplifiedInvoiceEndpoint;

trait IXApiGenerateCancelPayment
{
    public const GENERATE_PAYMENT = 'generate-payment';
    public const CANCEL_PAYMENT = 'cancel-payment';
    private const PARTIAL_PAYMENT_ROOT_OBJECT_KEY = 'partial_payment';
    private const PARTIAL_PAYMENT_RESPONSE_ROOT_OBJECT_KEY = 'receipt';

    /**
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function generatePayment(int $id, PartialPaymentData $data): InvoiceData
    {
        $this->checkAllowed(__FUNCTION__);

        $response = $this->call(
            action: static::GENERATE_PAYMENT,
            urlParams: compact('id'),
            bodyData: [self::PARTIAL_PAYMENT_ROOT_OBJECT_KEY => $data]
        );

        return $this->responseToDataObject($response[self::PARTIAL_PAYMENT_RESPONSE_ROOT_OBJECT_KEY]);
    }

    /**
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function cancelPayment(int $id, StateData $data): InvoiceData
    {
        $this->checkAllowed(__FUNCTION__);

        $data->

        $response =  $this->call(
            action: static::CANCEL_PAYMENT,
            urlParams: compact('id'),
            bodyData: [self::PARTIAL_PAYMENT_RESPONSE_ROOT_OBJECT_KEY => $data]
        );

        return $this->responseToDataObject($response[self::PARTIAL_PAYMENT_RESPONSE_ROOT_OBJECT_KEY]);
    }

    /**
     * @throws UnknownAPIMethodException
     */
    protected function checkAllowed(string $methodName): void
    {
        throw_unless(
            in_array(get_class($this), [IXInvoiceEndpoint::class, IXSimplifiedInvoiceEndpoint::class]),
            UnknownAPIMethodException::class,
            "'{$methodName}' cannot be called on this type of Invoice."
        );
    }
}
