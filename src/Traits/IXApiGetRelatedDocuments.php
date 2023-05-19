<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;

trait IXApiGetRelatedDocuments
{
    public const RELATED_DOCUMENTS = 'related-documents';

    /**
     * @throws RequestException
     */
    public function getRelatedDocuments(int $id): ?array
    {
        return $this->call(
            action: 'get',
            urlParams: compact('id')
        );
    }
}
