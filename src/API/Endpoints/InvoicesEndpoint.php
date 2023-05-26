<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Invoice.
 * https://invoicexpress.com/api-v2/invoices
 */

use Squarebit\InvoiceXpress\API\Concerns\ChangesState;
use Squarebit\InvoiceXpress\API\Concerns\CreatesWithType;
use Squarebit\InvoiceXpress\API\Concerns\Deletes;
use Squarebit\InvoiceXpress\API\Concerns\GeneratesCancelPayment;
use Squarebit\InvoiceXpress\API\Concerns\GeneratesPDF;
use Squarebit\InvoiceXpress\API\Concerns\GetsQRCode;
use Squarebit\InvoiceXpress\API\Concerns\GetsWithType;
use Squarebit\InvoiceXpress\API\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Concerns\RelatedDocuments;
use Squarebit\InvoiceXpress\API\Concerns\SendsByEmail;
use Squarebit\InvoiceXpress\API\Concerns\UpdatesWithType;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;

/**
 * @template-extends Endpoint<InvoiceData>
 */
class InvoicesEndpoint extends Endpoint
{
    /** @uses IXApiList<InvoiceData> */
    use Lists;

    /** @uses IXApiGet<InvoiceData> */
    use GetsWithType;

    /** @uses IXApiCreate<InvoiceData> */
    use CreatesWithType;

    /** @uses IXApiUpdate<InvoiceData> */
    use UpdatesWithType;

    /** @uses IXApiSendByEmail<InvoiceData> */
    use SendsByEmail;

    /** @uses IXApiGeneratePDF<InvoiceData> */
    use GeneratesPDF;

    /** @uses IXApiChangeState<InvoiceData> */
    use ChangesState;

    /** @uses IXApiGetQRCode<InvoiceData> */
    use GetsQRCode;

    /** @uses IXApiGenerateCancelPayment<InvoiceData> */
    use GeneratesCancelPayment;

    /** @uses IXApiGetRelatedDocuments<InvoiceData> */
    use RelatedDocuments;

    use Deletes;

    public const ENDPOINT_CONFIG = 'invoice';

    protected function responseToDataObject(array $data): InvoiceData
    {
        return InvoiceData::from($data);
    }

    protected function getEndpointName(): string
    {
        return static::ENDPOINT_CONFIG;
    }
}
