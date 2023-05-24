<?php

namespace Squarebit\InvoiceXpress\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Squarebit\InvoiceXpress\Enums\IXClientLanguageEnum;
use Squarebit\InvoiceXpress\Enums\IXClientSendOptionsEnum;
use Squarebit\InvoiceXpress\Enums\IXTaxExemptionCodeEnum;
use Squarebit\InvoiceXpress\Models\IXClient;

class IXClientFactory extends Factory
{
    protected $model = IXClient::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'code' => $this->faker->randomNumber(8),
            'language' => collect(IXClientLanguageEnum::values())->random(),
            'email' => $this->faker->email(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'fiscal_id' => $this->faker->randomNumber(9),
            'website' => $this->faker->domainName(),
            'country' => collect(['Portugal', 'Irland'])->random(),
            'phone' => $this->faker->e164PhoneNumber(),
            'fax' => $this->faker->e164PhoneNumber(),
            'preferred_contact' => [
                'name' => $this->faker->name(),
                'email' => $this->faker->email(),
                'phone' => $this->faker->e164PhoneNumber(),
            ],
            'observations' => $this->faker->text(),
            'send_options' => collect(IXClientSendOptionsEnum::values())->random(),
            'payment_days' => $this->faker->numberBetween(0, 60),
            'tax_exemption_code' => collect(IXTaxExemptionCodeEnum::names())->random(),
        ];
    }
}
