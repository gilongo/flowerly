<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class OrderFactory extends Factory
{

    /**
     * @inheritDoc
     */
    public function definition()
    {
        $customerIds = DB::table('customers')->pluck('id');

        return [
            'customer_id' => $this->faker->randomElement($customerIds),
            'description' => $this->faker->paragraph(2),
            'total_price' => $this->faker->randomFloat(2, 0, 1000),
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime())->format('Y-m-d H:i:s')
        ];
    }
}
