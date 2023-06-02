<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Enums\ClientSendOptionsEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;

class IxClient extends IxModel
{
    protected $casts = [
        'preferred_contact' => 'json',
        'send_options' => ClientSendOptionsEnum::class,
        'tax_exemption_code' => TaxExemptionCodeEnum::class,
    ];

    protected string $dataClass = ClientData::class;

    protected function getEndpoint(): ClientsEndpoint
    {
        return new ClientsEndpoint();
    }

    public function delete(): bool
    {
        throw new UnknownAPIMethodException(__('Endpoint does not support the delete method.'));
    }
}
