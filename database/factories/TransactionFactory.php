<?php

namespace Database\Factories;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $senderWallet = Wallet::inRandomOrder()->first() ?? Wallet::factory()->create();
        $receiverWallet = Wallet::inRandomOrder()->where('id', '!=', $senderWallet->id)
        ->first() ?? Wallet::factory()->create();

        return [
            'sender_wallet_id' => $senderWallet->id,
            'receiver_wallet_id' => $receiverWallet->id,
            'amount' => $this->faker->numberBetween(100, 10000), // مبلغ انتقال
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']), // وضعیت انتقال
        ];
    }
}
