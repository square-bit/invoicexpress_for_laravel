<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Client.
 * https://invoicexpress.com/api-v2/clients
 */

use Squarebit\InvoiceXpress\API\Concerns\IXApiCreate;
use Squarebit\InvoiceXpress\API\Concerns\IXApiDelete;
use Squarebit\InvoiceXpress\API\Concerns\IXApiFindByCode;
use Squarebit\InvoiceXpress\API\Concerns\IXApiFindByName;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGet;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGetWithType;
use Squarebit\InvoiceXpress\API\Concerns\IXApiList;
use Squarebit\InvoiceXpress\API\Concerns\IXApiListInvoices;
use Squarebit\InvoiceXpress\API\Concerns\IXApiUpdate;
use Squarebit\InvoiceXpress\API\Concerns\IXApiUpdateWithType;
use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;

/**
 * @template-extends IXEndpoint<ClientData>
 */
class IXClientEndpoint extends IXEndpoint
{
    /** @uses IXApiList<ClientData> */
    use IXApiList;

    /** @uses IXApiGet<ClientData> */
    use IXApiGet;

    /** @uses IXApiCreate<ClientData> */
    use IXApiCreate;

    /** @uses IXApiUpdate<ClientData> */
    use IXApiUpdate;

    /** @uses IXApiFindByCode<ClientData> */
    use IXApiFindByCode;

    /** @uses IXApiFindByName<ClientData> */
    use IXApiFindByName;

    /** @uses IXApiListInvoices<ClientData> */
    use IXApiListInvoices;

    use IXApiDelete;

    public const ENDPOINT_CONFIG = 'client';

    protected function responseToDataObject(array $data): ClientData
    {
        return ClientData::from($data);
    }

    protected function getEndpointName(): string
    {
        return static::ENDPOINT_CONFIG;
    }

    protected function getDocumentType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::Client;
    }
}
