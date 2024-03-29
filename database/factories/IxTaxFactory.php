<?php

namespace Squarebit\InvoiceXpress\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Squarebit\InvoiceXpress\Enums\TaxCodeEnum;
use Squarebit\InvoiceXpress\Enums\TaxRegionEnum;
use Squarebit\InvoiceXpress\Models\IxTax;

/**
 * @template-extends Factory<IxTax>
 */
class IxTaxFactory extends Factory
{
    protected $model = IxTax::class;

    public function definition()
    {
        return [
            'name' => fake()->name,
            'value' => fake()->randomFloat(2, 0, 50),
            'region' => collecT(TaxRegionEnum::values())->random(),
            'code' => collect(TaxCodeEnum::values())->random(),
            'defaultTax' => fake()->boolean,
        ];
    }
}
