<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Invoice.
 * https://invoicexpress.com/api-v2/invoices
 */

use Squarebit\InvoiceXpress\API\Concerns\IXApiChangeState;
use Squarebit\InvoiceXpress\API\Concerns\IXApiCreate;
use Squarebit\InvoiceXpress\API\Concerns\IXApiDelete;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGenerateCancelPayment;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGeneratePDF;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGet;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGetQRCode;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGetRelatedDocuments;
use Squarebit\InvoiceXpress\API\Concerns\IXApiList;
use Squarebit\InvoiceXpress\API\Concerns\IXApiSendByEmail;
use Squarebit\InvoiceXpress\API\Concerns\IXApiUpdate;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;

/**
 * @template-extends IXEndpoint<InvoiceData>
 */
class IXInvoiceEndpoint extends IXEndpoint
{
    /** @uses IXApiList<InvoiceData> */
    use IXApiList;

    /** @uses IXApiGet<InvoiceData> */
    use IXApiGet;

    /** @uses IXApiCreate<InvoiceData> */
    use IXApiCreate;

    /** @uses IXApiUpdate<InvoiceData> */
    use IXApiUpdate;

    /** @uses IXApiSendByEmail<InvoiceData> */
    use IXApiSendByEmail;

    /** @uses IXApiGeneratePDF<InvoiceData> */
    use IXApiGeneratePDF;

    /** @uses IXApiChangeState<InvoiceData> */
    use IXApiChangeState;

    /** @uses IXApiGetQRCode<InvoiceData> */
    use IXApiGetQRCode;

    /** @uses IXApiGenerateCancelPayment<InvoiceData> */
    use IXApiGenerateCancelPayment;

    /** @uses IXApiGetRelatedDocuments<InvoiceData> */
    use IXApiGetRelatedDocuments;

    use IXApiDelete;

    public const ENDPOINT_CONFIG = 'invoice';

    protected const JSON_ROOT_OBJECT_KEY = 'invoice';

    protected function responseToDataObject(array $data): InvoiceData
    {
        return InvoiceData::from($data);
    }

    protected function getEndpointName(): string
    {
        return static::ENDPOINT_CONFIG;
    }

    protected function getJsonRootObjectKey(): string
    {
        return static::JSON_ROOT_OBJECT_KEY;
    }

    protected function getEntityType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::Invoices;
    }
}
