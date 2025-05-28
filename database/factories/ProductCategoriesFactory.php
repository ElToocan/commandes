<?php

namespace Database\Factories;

use App\Models\ProductCategories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductCategoriesFactory extends Factory
{
    protected $model = ProductCategories::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
