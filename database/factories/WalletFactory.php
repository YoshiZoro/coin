<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // ایجاد کاربر مرتبط
            'sheba' => 'SA' . $this->faker->unique()->numerify(str_repeat('#', 21)), // تولید شناسه شبا
            'balance' => $this->faker->numberBetween(0, 100000), // موجودی تصادفی
        ];
    }
}
