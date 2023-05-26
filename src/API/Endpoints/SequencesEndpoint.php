<?php

namespace Squarebit\InvoiceXpress\API\Endpoints;

/*
 * This is the InvoiceXpress Sequence.
 * https://invoicexpress.com/api-v2/sequences
 */

use Squarebit\InvoiceXpress\API\Concerns\Creates;
use Squarebit\InvoiceXpress\API\Concerns\Gets;
use Squarebit\InvoiceXpress\API\Concerns\Lists;
use Squarebit\InvoiceXpress\API\Concerns\Updates;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;

class SequencesEndpoint //extends IXEndpoint
{
    use Lists;
    use Gets;
    use Creates;
    use Updates;

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
