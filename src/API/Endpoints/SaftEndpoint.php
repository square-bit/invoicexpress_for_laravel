<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Saft.
 * https://invoicexpress.com/api-v2/saf-t
 */

use Squarebit\InvoiceXpress\API\Data\SaftData;

/**
 * @extends  Endpoint<SaftData>
 */
class SaftEndpoint extends Endpoint
{
    public const ENDPOINT_CONFIG = 'saft';

    public const EXPORT_SAFT = 'export';

    protected function responseToDataObject(array $data): SaftData
    {
        return SaftData::from($data);
    }

    protected function getEndpointName(): string
    {
        return self::ENDPOINT_CONFIG;
    }

    public function export(int $year, int $month): SaftData
    {
        $data = $this->call(
            action: self::EXPORT_SAFT,
            urlParams: [
                'year' => $year,
                'month' => $month,
            ],
        );

        return $this->responseToDataObject($data);
    }
}
