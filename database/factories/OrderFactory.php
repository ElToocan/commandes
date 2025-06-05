<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'table_number' => $this->faker->randomNumber(),
            'person_number' => $this->faker->randomNumber(),
            'delivery_time' => Carbon::now(),
            'name' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'comment' => $this->faker->text(),
            'state' => $this->faker->word(),
            'type' => $this->faker->word(),
            'paid' => $this->faker->boolean(),
            'total_price' => $this->faker->randomFloat(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
