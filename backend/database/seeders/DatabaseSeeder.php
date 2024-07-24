<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Flowerly User',
            'email' => 'test@flowerly.com',
            'password' => Hash::make('password'),
        ]);

        Product::factory(10)->create();

        \App\Models\Customer::factory(5)->create()->each(function ($customer) {
            \App\Models\Order::factory(rand(1, 3))->create(['customer_id' => $customer->id])->each(function ($order) {
                $products = \App\Models\Product::inRandomOrder()->take(rand(1, 3))->get();
                $totalPrice = 0;

                foreach ($products as $product) {
                    $quantity = rand(1, 5);
                    $order->products()->attach($product->id, ['quantity' => $quantity]);
                    $totalPrice += $product->price * $quantity;
                }

                $order->update(['total_price' => $totalPrice]);
            });
        });
    }
}
