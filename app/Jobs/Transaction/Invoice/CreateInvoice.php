<?php

namespace App\Jobs\Transaction\Invoice;

use App\Events\Transaction\Invoice\InvoiceCreated;
use App\Models\Transaction\Invoice;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateInvoice
{
    use Dispatchable, SerializesModels;

    protected array $attributes;
    public Invoice $invoice;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attributes = [],$status=Invoice::INVOICE_STATUS_CREATED)
    {
        $attributes = array_merge($attributes,['status'=>$status]);
        $this->attributes = $attributes;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $this->invoice = new Invoice($this->attributes);
        $this->invoice->save();

        if ($this->invoice->exists){
            \event(new InvoiceCreated($this->invoice));
        }
        return $this->invoice->exists;
    }
}
