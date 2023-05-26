<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Tax.
 * https://invoicexpress.com/api-v2/taxes
 */

use Squarebit\InvoiceXpress\API\Concerns\Creates;
use Squarebit\InvoiceXpress\API\Concerns\Deletes;
use Squarebit\InvoiceXpress\API\Concerns\GetsWithType;
use Squarebit\InvoiceXpress\API\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Concerns\UpdatesWithType;
use Squarebit\InvoiceXpress\API\Data\TaxData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;

/**
 * @template-extends Endpoint<TaxData>
 */
class TaxesEndpoint extends Endpoint
{
    use Lists;
    use GetsWithType;
    use UpdatesWithType;
    use Creates;
    use Deletes;

    public const ENDPOINT_CONFIG = 'tax';

    protected const JSON_ROOT_OBJECT_KEY = 'tax';

    protected function responseToDataObject(array $data): TaxData
    {
        return TaxData::from($data[self::JSON_ROOT_OBJECT_KEY]);
    }

    protected function getEndpointName(): string
    {
        return self::ENDPOINT_CONFIG;
    }

    protected function getJsonRootObjectKey(): string
    {
        return static::JSON_ROOT_OBJECT_KEY;
    }

    protected function getDocumentType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::Tax;
    }
}
