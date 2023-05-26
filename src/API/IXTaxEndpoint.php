<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Tax.
 * https://invoicexpress.com/api-v2/taxes
 */

use Squarebit\InvoiceXpress\API\Concerns\IXApiCreate;
use Squarebit\InvoiceXpress\API\Concerns\IXApiDelete;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGet;
use Squarebit\InvoiceXpress\API\Concerns\IXApiList;
use Squarebit\InvoiceXpress\API\Concerns\IXApiUpdate;
use Squarebit\InvoiceXpress\API\Data\TaxData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;

/**
 * @template-extends IXEndpoint<TaxData>
 */
class IXTaxEndpoint extends IXEndpoint
{
    use IXApiList;
    use IXApiGet;
    use IXApiUpdate;
    use IXApiCreate;
    use IXApiDelete;

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
