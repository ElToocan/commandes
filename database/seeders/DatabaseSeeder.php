<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        for ($i=0;$i<20;$i++) {
            Order::factory()
                ->count(1)
                ->has(OrderLine::factory()->count(5))
                ->create();
        }

        ProductCategories::factory()
            ->count(2)
            ->has(Product::factory()->count(10), 'products')
            ->create();


    }
}
