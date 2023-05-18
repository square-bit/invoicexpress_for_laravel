<?php

namespace Squarebit\InvoiceXpress\Traits;

use Illuminate\Http\Client\RequestException;
use Squarebit\InvoiceXpress\Enums\InvoiceTypeEnum;

trait IXApiChangeState
{
    public const CHANGE_STATE = 'change-state';

    /**
     * @throws RequestException
     */
    public function changeState(InvoiceTypeEnum $type, int $id, array $data): ?array
    {
        return $this->call(
            action: 'change-state',
            urlParams: [
                'type' => $type->value,
                'id' => $id,
            ],
            bodyData: $data
        );
    }
}
