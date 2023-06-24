<?php

namespace Squarebit\InvoiceXpress\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Squarebit\InvoiceXpress\Enums\ClientSendOptionsEnum;
use Squarebit\InvoiceXpress\Enums\CountryEnum;
use Squarebit\InvoiceXpress\Enums\TaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\Models\IxClient;

/**
 * @template-extends Factory<IxClient>
 */
class IxClientFactory extends Factory
{
    protected $model = IxClient::class;

    public function definition()
    {
        return [
            'name' => fake()->name,
            'code' => fake()->text(8),

            'email' => fake()->email,
            'address' => fake()->streetAddress,
            'city' => fake()->city,
            'postal_code' => fake()->postcode,
            'fiscal_id' => 999999990,
            'website' => fake()->url,
            'country' => collect(CountryEnum::values())->random(),
            'phone' => fake()->phoneNumber,
            'fax' => fake()->phoneNumber,
            'preferred_contact' => [
                'name' => fake()->name,
                'email' => fake()->email,
            ],
            'observations' => fake()->text(128),
            'send_options' => collect(ClientSendOptionsEnum::values())->random(),
            'payment_days' => random_int(1, 365),
            'tax_exemption_code' => collect(TaxExemptionCodeEnum::values())->random(),
        ];
    }
}
