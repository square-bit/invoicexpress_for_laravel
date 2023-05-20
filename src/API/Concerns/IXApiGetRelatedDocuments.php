<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

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
            action: static::RELATED_DOCUMENTS,
            urlParams: compact('id')
        );
    }
}
