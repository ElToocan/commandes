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
            'person_number' => random_int(2,6),
            'delivery_time' => Carbon::today()->addHours(random_int(0,24))->format('Y-m-d H:i:s'),
            'name' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'comment' => $this->faker->text(),
            'state' => collect(['en_attente','terminer'])->random(),
            'type' => collect(['sur_place','emporter'])->random(),
            'paid' => $this->faker->boolean(),
            'total_price' => $this->faker->randomFloat(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
