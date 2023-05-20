<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Invoice.
 * https://invoicexpress.com/api-v2/invoices
 */

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Enums\InvoiceTypeEnum;
use Squarebit\InvoiceXpress\API\Concerns\IXApiCancelPayment;
use Squarebit\InvoiceXpress\API\Concerns\IXApiChangeState;
use Squarebit\InvoiceXpress\API\Concerns\IXApiCreate;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGeneratePayment;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGeneratePDF;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGet;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGetQRCode;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGetRelatedDocuments;
use Squarebit\InvoiceXpress\API\Concerns\IXApiList;
use Squarebit\InvoiceXpress\API\Concerns\IXApiSendByEmail;
use Squarebit\InvoiceXpress\API\Concerns\IXApiUpdate;

class IXInvoiceEndpoint extends IXEndpoint
{
    use IXApiList;
    use IXApiGet;
    use IXApiCreate;
    use IXApiUpdate;
    use IXApiSendByEmail;
    use IXApiGeneratePDF;
    use IXApiChangeState;
    use IXApiGetQRCode;
    use IXApiGeneratePayment;
    use IXApiCancelPayment;
    use IXApiGetRelatedDocuments;

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
}