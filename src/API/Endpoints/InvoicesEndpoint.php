<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Invoice.
 * https://invoicexpress.com/api-v2/invoices
 */

use Squarebit\InvoiceXpress\API\Concerns\ChangesState;
use Squarebit\InvoiceXpress\API\Concerns\CreatesWithType;
use Squarebit\InvoiceXpress\API\Concerns\Deletes;
use Squarebit\InvoiceXpress\API\Concerns\GeneratesAndCancelsPayment;
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
    /** @uses Lists<InvoiceData> */
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
