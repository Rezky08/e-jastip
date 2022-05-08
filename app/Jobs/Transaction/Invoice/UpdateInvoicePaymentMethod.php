<?php

namespace App\Jobs\Transaction\Invoice;

use App\Events\Transaction\Invoice\InvoicePaymentMethodUpdated;
use App\Models\PaymentMethod\Account;
use App\Models\Transaction\Invoice\Invoice;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UpdateInvoicePaymentMethod
{
    use Dispatchable, SerializesModels;

    public Invoice $invoice;
    public Account $account;
    public array $attributes;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice, $attributes = [])
    {

        $this->invoice = $invoice;
        $this->attributes = Validator::make($attributes, [
            'payment_method_account_id' => ['required', 'filled', 'exists:' . Account::getTableName() . ',id']
        ])->validate();

        /** @var Account $account */
        $account = Account::query()->find($this->attributes['payment_method_account_id']);
        throw_if(empty($account), ValidationException::withMessages(['payment_method_account_id' => 'metode pembayaran tidak ditemukan']));

        $this->account = $account;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->invoice->account()->associate($this->account);
        $this->invoice->save();
        if ($this->invoice->account->exists){
            event(new InvoicePaymentMethodUpdated($this->invoice));
        }
        return $this->invoice->account->exists;
    }
}
