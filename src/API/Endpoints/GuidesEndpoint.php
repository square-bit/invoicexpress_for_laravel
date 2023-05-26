<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Guide.
 * https://invoicexpress.com/api-v2/guides
 */

use Spatie\LaravelData\Data;
use Squarebit\InvoiceXpress\API\Concerns\ChangesState;
use Squarebit\InvoiceXpress\API\Concerns\CreatesWithType;
use Squarebit\InvoiceXpress\API\Concerns\GeneratesPDF;
use Squarebit\InvoiceXpress\API\Concerns\GetsQRCode;
use Squarebit\InvoiceXpress\API\Concerns\GetsWithType;
use Squarebit\InvoiceXpress\API\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Concerns\SendsByEmail;
use Squarebit\InvoiceXpress\API\Concerns\UpdatesWithType;
use Squarebit\InvoiceXpress\API\Data\GuideData;

/**
 * @template-extends Endpoint<GuideData>
 */
class GuidesEndpoint extends Endpoint
{
    use SendsByEmail;
    use GeneratesPDF;
    use GetsWithType;
    use Lists;
    use CreatesWithType;
    use UpdatesWithType;
    use ChangesState;
    use GetsQRCode;

    public const ENDPOINT_CONFIG = 'guide';

    protected function responseToDataObject(array $data): GuideData
    {
        return GuideData::from($data);
    }

    protected function getEndpointName(): string
    {
        return self::ENDPOINT_CONFIG;
    }
}
