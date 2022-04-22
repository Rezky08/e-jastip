<?php

namespace Database\Factories\PaymentMethod;

use App\Models\Master\Faculty;
use App\Models\PaymentMethod\Account;
use App\Models\PaymentMethod\PaymentMethod;
use App\Supports\PaymentMethodSupport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod\Account>
 */
class AccountFactory extends Factory
{
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = PaymentMethod::query()->inRandomOrder()->first();
        $faculty = Faculty::query()->inRandomOrder()->first();
        $isQris = $paymentMethod->type === PaymentMethod::TYPE_QRIS;

        return [
            'faculty_id' => $faculty->id,
            'payment_method_id' => $paymentMethod->id,
            'account' => $this->faker->creditCardNumber(),
            'qr' => $isQris ? $this->faker->imageUrl() : null,
            'isActive' => $this->faker->boolean(),
        ];
    }
}
