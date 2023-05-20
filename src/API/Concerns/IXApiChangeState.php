<?php

namespace Squarebit\InvoiceXpress\API\Concerns;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\API\Enums\InvoiceTypeEnum;

trait IXApiChangeState
{
    public const CHANGE_STATE = 'change-state';

    /**
     * @throws RequestException
     */
    public function changeState(InvoiceTypeEnum $type, int $id, array $data): ?array
    {
        return $this->call(
            action: static::CHANGE_STATE,
            urlParams: [
                'type' => $type->value,
                'id' => $id,
            ],
            bodyData: $data
        );
    }
}
