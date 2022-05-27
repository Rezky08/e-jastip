<?php

namespace App\Jobs\Transaction\Invoice;

use App\Events\Transaction\Invoice\InvoicePaymentConfirmed;
use App\Models\Transaction\Invoice\Invoice;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ConfirmInvoicePayment
{
    use Dispatchable, SerializesModels;

    public Invoice $invoice;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $statusLabel = Invoice::getAvailableStatus()[Invoice::INVOICE_STATUS_WAITING_CONFIRMATION];
        $currentStatusLabel = Invoice::getAvailableStatus()[$invoice->status];
        $message = __('validation.invoice.status.invalid', ['status' => $statusLabel, 'current_status' => $currentStatusLabel]);
        Validator::validate(
            [
                'status' => $invoice->status,
            ],
            [
                'status' => [Rule::in([Invoice::INVOICE_STATUS_WAITING_CONFIRMATION])]
            ],
            [
                'status.in' => $message
            ],
        );
        $this->invoice = $invoice;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $job = new UpdateInvoiceStatus($this->invoice,Invoice::INVOICE_STATUS_CONFIRMED);
        dispatch($job);
        $this->invoice = $job->invoice;

        if ($this->invoice->wasChanged()){
            event(new InvoicePaymentConfirmed($this->invoice));
        }

        return $this->invoice->wasChanged();
    }
}
