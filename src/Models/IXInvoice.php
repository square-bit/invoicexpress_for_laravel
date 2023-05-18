<?php

namespace Squarebit\InvoiceXpress\Models;

/*
 * This is the InvoiceXpress Invoice.
 * https://invoicexpress.com/api-v2/invoices
 */

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\Enums\InvoiceTypeEnum;
use Squarebit\InvoiceXpress\Traits\IXApiChangeState;
use Squarebit\InvoiceXpress\Traits\IXApiCreate;
use Squarebit\InvoiceXpress\Traits\IXApiGeneratePDF;
use Squarebit\InvoiceXpress\Traits\IXApiGet;
use Squarebit\InvoiceXpress\Traits\IXApiGetQRCode;
use Squarebit\InvoiceXpress\Traits\IXApiList;
use Squarebit\InvoiceXpress\Traits\IXApiSendByEmail;
use Squarebit\InvoiceXpress\Traits\IXApiUpdate;

class IXInvoice extends IXEntity
{
    use IXApiList;
    use IXApiGet;
    use IXApiCreate;
    use IXApiUpdate;
    use IXApiSendByEmail;
    use IXApiGeneratePDF;
    use IXApiChangeState;
    use IXApiGetQRCode;

    public const RELATED_DOCUMENTS = 'related-documents';
    public const GENERATE_PAYMENT = 'generate-payment';
    public const CANCEL_PAYMENT = 'cancel-payment';
    protected static string $endpointConfig = 'invoice';

    /**
     * @throws RequestException
     */
    public function listType(InvoiceTypeEnum $type, array $queryParams = []): ?array
    {
        return $this->list(array_merge($queryParams, ['type[]' => $type->value]));
    }

    /**
     * @throws RequestException
     */
    public function listInvoice(array $queryParams = []): ?array
    {
        return $this->listType(InvoiceTypeEnum::Invoice, $queryParams);
    }

    /**
     * @throws RequestException
     */
    public function listInvoiceReceipt(array $queryParams = []): ?array
    {
        return $this->listType(InvoiceTypeEnum::InvoiceReceipt, $queryParams);
    }

    /**
     * @throws RequestException
     */
    public function listSimplifiedInvoice(array $queryParams = []): ?array
    {
        return $this->listType(InvoiceTypeEnum::SimplifiedInvoice, $queryParams);
    }

    /**
     * @throws RequestException
     */
    public function listVatMossInvoice(array $queryParams = []): ?array
    {
        return $this->listType(InvoiceTypeEnum::VatMossInvoice, $queryParams);
    }

    /**
     * @throws RequestException
     */
    public function listCreditNote(array $queryParams = []): ?array
    {
        return $this->listType(InvoiceTypeEnum::CreditNote, $queryParams);
    }

    /**
     * @throws RequestException
     */
    public function listDebitNote(array $queryParams = []): ?array
    {
        return $this->listType(InvoiceTypeEnum::DebitNote, $queryParams);
    }

    /**
     * @throws RequestException
     */
    public function listReceipt(array $queryParams = []): ?array
    {
        return $this->listType(InvoiceTypeEnum::Receipt, $queryParams);
    }

    /**
     * @throws RequestException
     */
    public function listCashInvoice(array $queryParams = []): ?array
    {
        return $this->listType(InvoiceTypeEnum::CashInvoice, $queryParams);
    }

    /**
     * @throws RequestException
     */
    public function listVatMossReceipt(array $queryParams = []): ?array
    {
        return $this->listType(InvoiceTypeEnum::VatMossReceipt, $queryParams);
    }

    /**
     * @throws RequestException
     */
    public function listVatMossCreditNote(array $queryParams = []): ?array
    {
        return $this->listType(InvoiceTypeEnum::VatMossCreditNote, $queryParams);
    }

    /**
     * @throws RequestException
     */
    public function getRelatedDocuments(int $id): ?array
    {
        return $this->call(
            action: 'get',
            urlParams: compact('id')
        );
    }

    /**
     * @throws RequestException
     */
    public function generatePayment(int $id, array $data): ?array
    {
        return $this->call(
            action: 'generate-payment',
            urlParams: compact('id')
        );
    }

    /**
     * @throws RequestException
     */
    public function cancelPayment(int $id, array $data): ?array
    {
        return $this->call(
            action: 'cancel-payment',
            urlParams: compact('id'),
            bodyData: $data
        );
    }
}
