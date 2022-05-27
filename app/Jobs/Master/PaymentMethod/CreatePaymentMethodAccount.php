<?php

namespace App\Jobs\Master\PaymentMethod;

use App\Contracts\PaymentMethodAccountableContract;
use App\Models\PaymentMethod\Account;
use App\Models\PaymentMethod\PaymentMethod;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreatePaymentMethodAccount
{
    use Dispatchable, SerializesModels;

    public array $attributes;
    public Account $account;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attributes = [])
    {
        $this->attributes = Validator::make($attributes, [
            'payment_method_id' => ['required', 'filled', 'unique:' . Account::getTableName() . ',payment_method_id', 'exists:' . PaymentMethod::getTableName() . ',' . PaymentMethod::getInstance()->getKeyName()],
            'name' => ['required', 'filled'],
            'account' => ['required', 'filled'],
            'qr' => ['nullable'],
            'isActive' => ['filled', 'boolean']
        ])->validate();

    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->account = new Account();

        $this->account->fill($this->attributes);
        $this->account->save();

        return $this->account->exists;

    }
}
