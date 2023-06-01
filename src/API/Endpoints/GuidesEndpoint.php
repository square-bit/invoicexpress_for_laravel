<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Guide.
 * https://invoicexpress.com/api-v2/guides
 */

use Squarebit\InvoiceXpress\API\Data\GuideData;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\ChangesState;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\CreatesWithType;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\GeneratesPDF;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\GetsQRCode;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\GetsWithType;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\SendsByEmail;
use Squarebit\InvoiceXpress\API\Endpoints\Concerns\UpdatesWithType;

/**
 * @template-extends Endpoint<GuideData>
 */
class GuidesEndpoint extends Endpoint
{
    use SendsByEmail;
    use GeneratesPDF;

    /** @uses GetsWithType<GuideData> */
    use GetsWithType;

    /** @uses Lists<GuideQueryFilter> */
    use Lists;

    /** @uses CreatesWithType<GuideData> */
    use CreatesWithType;

    /** @uses UpdatesWithType<GuideData> */
    use UpdatesWithType;

    /** @uses ChangesState<GuideData> */
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
