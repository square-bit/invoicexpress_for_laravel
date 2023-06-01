<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Invoice.
 * https://invoicexpress.com/api-v2/invoices
 */

use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\ChangesState;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\CreatesWithType;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\GeneratesAndCancelsPayment;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\GeneratesPDF;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\GetsQRCode;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\GetsWithType;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\RelatedDocuments;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\SendsByEmail;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\UpdatesWithType;

/**
 * @template-extends Endpoint<InvoiceData>
 */
class InvoicesEndpoint extends Endpoint
{
    /** @uses Lists<InvoiceQueryFilter> */
    use Lists;

    /** @uses GetsWithType<InvoiceData> */
    use GetsWithType;

    /** @uses CreatesWithType<InvoiceData> */
    use CreatesWithType;

    /** @uses UpdatesWithType<InvoiceData> */
    use UpdatesWithType;

    /** @uses SendsByEmail<InvoiceData> */
    use SendsByEmail;

    /** @uses GeneratesPDF<InvoiceData> */
    use GeneratesPDF;

    /** @uses ChangesState<InvoiceData> */
    use ChangesState;

    /** @uses GetsQRCode<InvoiceData> */
    use GetsQRCode;

    /** @uses GeneratesAndCancelsPayment<InvoiceData> */
    use GeneratesAndCancelsPayment;

    /** @uses RelatedDocuments<InvoiceData> */
    use RelatedDocuments;

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
