<?php

namespace Squarebit\InvoiceXpress\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Squarebit\InvoiceXpress\Models\IxItem;

/**
 * @property null|string $description
 * @property null|string $name
 * @property null|array $tax
 * @property null|string $unit
 * @property null|float $unit_price
 *
 * @template-extends Factory<IxItem>
 */
class IxItemFactory extends Factory
{
    protected $model = IxItem::class;

    public function definition()
    {
        return [
            'name' => fake()->name,
            'description' => fake()->text,
            'unit_price' => fake()->randomFloat(2),
            'unit' => 'unit',
            'tax' => IxTaxFactory::new()->make()->toArray(),
        ];
    }
}
