<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Invoice.
 * https://invoicexpress.com/api-v2/invoices
 */

use Squarebit\InvoiceXpress\API\Data\Filters\InvoiceListFilter;
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
    /** @use ChangesState<InvoiceData> */
    use ChangesState;

    /** @use CreatesWithType<InvoiceData> */
    use CreatesWithType;

    use GeneratesAndCancelsPayment;
    use GeneratesPDF;
    use GetsQRCode;

    /** @use GetsWithType<InvoiceData> */
    use GetsWithType;

    /** @use Lists<InvoiceListFilter, InvoiceData> */
    use Lists;

    /** @use RelatedDocuments<InvoiceData> */
    use RelatedDocuments;

    use SendsByEmail;

    /** @use UpdatesWithType<InvoiceData> */
    use UpdatesWithType;

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
