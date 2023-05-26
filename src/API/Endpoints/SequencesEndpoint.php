<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Sequence.
 * https://invoicexpress.com/api-v2/sequences
 */

use Illuminate\Http\Client\RequestException;
use Spatie\LaravelData\Data;
use Squarebit\InvoiceXpress\API\Concerns\Creates;
use Squarebit\InvoiceXpress\API\Concerns\Gets;
use Squarebit\InvoiceXpress\API\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Concerns\Updates;
use Squarebit\InvoiceXpress\API\Data\SequenceData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

/**
 * @extends  Endpoint<SequenceData>
 */
class SequencesEndpoint extends Endpoint
{
    use Lists;

    /** @uses Gets<SequenceData> */
    use Gets;

    /** @uses Creates<SequenceData> */
    use Creates;

    /** @uses Updates<SequenceData> */
    use Updates;

    public const ENDPOINT_CONFIG = 'item';

    public const REGISTER = 'register';

    protected function getEndpointName(): string
    {
        return self::ENDPOINT_CONFIG;
    }

    protected function getEntityType(): EntityTypeEnum
    {
        return EntityTypeEnum::Sequence;
    }

    protected function responseToDataObject(array $data): Data
    {
        return SequenceData::from($data);
    }

    /**
     * @throws RequestException
     * @throws UnknownAPIMethodException
     */
    public function register(int $id): SequenceData
    {
        $response = $this->call(
            action: static::REGISTER,
            urlParams: compact('id')
        );

        return $this->responseToDataObject($response['sequences'][0]);
    }
}
