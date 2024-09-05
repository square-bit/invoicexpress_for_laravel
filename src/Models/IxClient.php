<?php

namespace Squarebit\InvoiceXpress\Models;

use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\API\Endpoints\ClientsEndpoint;
use Squarebit\InvoiceXpress\API\Exceptions\UnknownAPIMethodException;
use Squarebit\InvoiceXpress\Enums\ClientSendOptionsEnum;
use Squarebit\InvoiceXpress\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Enums\TaxExemptionCodeEnum;

/**
 * @property null|string $address
 * @property null|string $city
 * @property null|string $code
 * @property null|string $country
 * @property null|string $email
 * @property null|string $fax
 * @property null|string $fiscal_id
 * @property null|string $name
 * @property null|string $observations
 * @property null|string $payment_days
 * @property null|string $phone
 * @property null|string $postal_code
 * @property null|array $preferred_contact
 * @property null|ClientSendOptionsEnum $send_options
 * @property null|TaxExemptionCodeEnum $tax_exemption_code
 * @property null|string $website
 *
 * @template-extends IxModel<ClientData>
 */
class IxClient extends IxModel
{
    protected EntityTypeEnum $entityType = EntityTypeEnum::Client;

    protected string $dataClass = ClientData::class;

    protected $casts = [
        'preferred_contact' => 'json',
        'send_options' => ClientSendOptionsEnum::class,
        'tax_exemption_code' => TaxExemptionCodeEnum::class,
    ];

    public function getEndpoint(): ClientsEndpoint
    {
        return new ClientsEndpoint;
    }

    public function delete(): bool
    {
        throw new UnknownAPIMethodException(__('Endpoint does not support the delete method.'));
    }
}
