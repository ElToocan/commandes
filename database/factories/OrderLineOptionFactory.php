<?php

namespace Database\Factories;

use App\Models\Option;
use App\Models\OrderLine;
use App\Models\OrderLineOption;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderLineOptionFactory extends Factory
{
    protected $model = OrderLineOption::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'order_line_id' => OrderLine::factory(),
            'option_id' => Option::factory(),
        ];
    }
}
