<?php

namespace Squarebit\InvoiceXpress\API;

/*
 * This is the InvoiceXpress Sequence.
 * https://invoicexpress.com/api-v2/sequences
 */

use Squarebit\InvoiceXpress\API\Concerns\IXApiCreate;
use Squarebit\InvoiceXpress\API\Concerns\IXApiGet;
use Squarebit\InvoiceXpress\API\Concerns\IXApiList;
use Squarebit\InvoiceXpress\API\Concerns\IXApiUpdate;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;

class IXSequenceEndpoint //extends IXEndpoint
{
    use IXApiList;
    use IXApiGet;
    use IXApiCreate;
    use IXApiUpdate;

    public const ENDPOINT_CONFIG = 'item';

    public const REGISTER = 'register';

    protected function getEndpointName(): string
    {
        return self::ENDPOINT_CONFIG;
    }

    public function register(): array
    {
        return $this->call('register');
    }

    protected function getDocumentType(): DocumentTypeEnum
    {
        return DocumentTypeEnum::Client;
    }
}
