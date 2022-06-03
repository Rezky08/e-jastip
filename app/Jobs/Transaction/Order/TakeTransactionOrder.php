<?php

namespace App\Jobs\Transaction\Order;

use App\Events\Transaction\Order\TransactionOrderTaken;
use App\Models\Master\Sprinter;
use App\Models\Setting\Setting;
use App\Models\Transaction\Order;
use App\Models\Transaction\Transaction;
use App\Supports\SettingSupport;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Rezky\LaravelResponseFormatter\Exception\Error;
use Rezky\LaravelResponseFormatter\Http\Response;

class TakeTransactionOrder
{
    use Dispatchable, SerializesModels;

    public Sprinter $sprinter;
    public Transaction $transaction;
    public Order $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Sprinter $sprinter, Transaction $transaction)
    {

        $this->sprinter = $sprinter;
        $this->transaction = $transaction;

        $data = [
            'transaction_id' => $transaction->id
        ];

        Validator::make($data, [
            'transaction_id' => [
                'required',
                'filled',
                function ($attribute, $value, $fail) {
                    $isMaxTaken = $this->sprinter->orders()->count() >= SettingSupport::getSettingByKey(Setting::KEY_MAX_SPRINTER_ORDER_TAKEN);
                    if ($isMaxTaken) {
                        $fail(__('validation.order.transaction.max'));
                    }
                },
                function ($attribute, $value, $fail) {
                    $isAlreadyTaken = $this->sprinter->orders()->where('transaction_id', $value)->exists();
                    if ($isAlreadyTaken) {
                        $fail(__('validation.order.transaction.taken', ['id' => $this->transaction->token]));
                    }
                },
            ]
        ])->validate();


        $this->order = new Order();
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $this->order->status = Order::ORDER_STATUS_TAKEN;
        $this->order->transaction()->associate($this->transaction);
        $this->order->sprinter()->associate($this->sprinter);
        $this->order->save();

        if ($this->order->exists) {
            event(new TransactionOrderTaken($this->order));
        }
        return $this->order->exists;

    }
}
