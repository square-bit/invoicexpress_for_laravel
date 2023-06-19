<?php

namespace Squarebit\InvoiceXpress\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Squarebit\InvoiceXpress\Models\IxItem;

class IxItemFactory extends Factory
{
    protected $model = IxItem::class;

    public function definition()
    {
        return [
            'name' => fake()->name,
            'description' => fake()->text,
            'unitPrice' => fake()->randomFloat(2),
            'unit' => 'unit',
            'tax' => IxTaxFactory::new()->make()->toArray(),
        ];
    }
}
