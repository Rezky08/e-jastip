<?php

namespace App\Jobs\Transaction\Invoice;

use App\Models\Transaction\Invoice\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;

class UploadInvoicePaymentConfirmation
{
    use Dispatchable, SerializesModels;

    public array $attributes;
    private Invoice $invoice;

    /**
     * Create a new job instance.
     *
     * @param array $attributes
     */
    public function __construct(Invoice $invoice,$attributes=[])
    {

        $this->attributes = Validator::make($attributes,[
            'holder_name' => ['required','filled'],
            'file' => ['required','filled','file']
        ])->validate();
        $this->invoice = $invoice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        dd($this->attributes);
    }
}
