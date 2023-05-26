<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Data\PartialPaymentData;
use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;
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
    public function generatePayment(DocumentTypeEnum $documentType, int $id, PartialPaymentData $data): InvoiceData
    {
        $this->checkAllowed($documentType, __FUNCTION__);

        $response = $this->call(
            action: static::GENERATE_PAYMENT,
            urlParams: [
                'type' => $documentType->toUrlVariable(),
                'id' => $id,
            ],
            bodyData: [self::PARTIAL_PAYMENT_ROOT_OBJECT_KEY => $data]
        );

        return $this->responseToDataObject($response[self::PARTIAL_PAYMENT_RESPONSE_ROOT_OBJECT_KEY]);
    }

    /**
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function cancelPayment(DocumentTypeEnum $documentType, int $id, StateData $data): InvoiceData
    {
        $this->checkAllowed($documentType, __FUNCTION__);

        $response = $this->call(
            action: static::CANCEL_PAYMENT,
            urlParams: [
                'type' => $documentType->toUrlVariable(),
                'id' => $id,
            ],
            bodyData: [self::PARTIAL_PAYMENT_RESPONSE_ROOT_OBJECT_KEY => $data]
        );

        return $this->responseToDataObject($response[self::PARTIAL_PAYMENT_RESPONSE_ROOT_OBJECT_KEY]);
    }

    /**
     * @throws UnknownAPIMethodException
     */
    protected function checkAllowed(DocumentTypeEnum $documentType, string $methodName): void
    {
        throw_unless(
            in_array($documentType, [DocumentTypeEnum::Invoice, DocumentTypeEnum::SimplifiedInvoice], true),
            UnknownAPIMethodException::class,
            "'{$methodName}' cannot be called on this type of Invoice."
        );
    }
}
