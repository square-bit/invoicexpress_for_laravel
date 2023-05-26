<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Data\EntityData;
use Squarebit\InvoiceXpress\API\Data\StateData;
use Squarebit\InvoiceXpress\API\Enums\DocumentTypeEnum;

/**
 * @template TData of EntityData
 */
trait ChangesState
{
    public const CHANGE_STATE = 'change-state';

    /**
     * @param  TData  $data
     * @return TData
     *
     * @throws RequestException
     * @throws
     */
    public function changeState(DocumentTypeEnum $documentType, int $id, StateData $data): EntityData
    {
        $response = $this->call(
            action: static::CHANGE_STATE,
            urlParams: [
                'type' => $this->documentTypeToUrlVariable($documentType),
                'id' => $id,
            ],
            bodyData: [$documentType->value => $data->toArray()]
        );

        return $this->responseToDataObject($response[$documentType->value]);
    }
}
