<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Invoice.
 * https://invoicexpress.com/api-v2/invoices
 */

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
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;

/**
 * @template-extends IXEndpoint<InvoiceData>
 */
class IXInvoiceEndpoint extends IXEndpoint
{
    /** @uses IXApiList<InvoiceData> */
    use IXApiList;

    /** @uses IXApiList<InvoiceData> */
    use IXApiGet;

    /** @uses IXApiList<InvoiceData> */
    use IXApiCreate;

    /** @uses IXApiList<InvoiceData> */
    use IXApiUpdate;

    /** @uses IXApiList<InvoiceData> */
    use IXApiSendByEmail;

    /** @uses IXApiList<InvoiceData> */
    use IXApiGeneratePDF;

    /** @uses IXApiList<InvoiceData> */
    use IXApiChangeState;

    /** @uses IXApiList<InvoiceData> */
    use IXApiGetQRCode;

    /** @uses IXApiList<InvoiceData> */
    use IXApiGeneratePayment;

    /** @uses IXApiList<InvoiceData> */
    use IXApiCancelPayment;

    /** @uses IXApiList<InvoiceData> */
    use IXApiGetRelatedDocuments;

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

    protected function getEntityType(): EntityTypeEnum
    {
        return EntityTypeEnum::Invoices;
    }
}
