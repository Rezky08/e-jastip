<?php

namespace App\Jobs\Transaction\Invoice;

use App\Events\Transaction\Invoice\InvoiceUpdated;
use App\Models\Transaction\Invoice\Invoice;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateInvoiceStatus
{
    use Dispatchable, SerializesModels;

    public array $attributes;
    public Invoice $invoice;

    /**
     * Create a new job instance.
     *
     * @param Invoice $invoice
     * @param $status
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __construct(Invoice $invoice, $status)
    {
        $this->invoice = $invoice;
        $this->attributes = Validator::make(['status' => $status], ['status' => Rule::in(array_keys(Invoice::getAvailableStatus()))])->validate();
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->invoice->status = $this->attributes['status'];
        $this->invoice->save();
        if ($this->invoice->exists) {
            event(new InvoiceUpdated($this->invoice));
        }
        return $this->invoice->wasChanged();
    }
}
