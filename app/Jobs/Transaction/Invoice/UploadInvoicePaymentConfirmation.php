<?php

namespace App\Jobs\Transaction\Invoice;

use App\Events\Transaction\Invoice\InvoicePaymentConfirmationUploaded;
use App\Models\Pivot\Transaction\InvoiceAttachment;
use App\Models\Transaction\Invoice\Invoice;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Jalameta\Attachments\Concerns\AttachmentCreator;
use Jalameta\Attachments\Entities\Attachment;

class UploadInvoicePaymentConfirmation
{
    use Dispatchable, SerializesModels, AttachmentCreator;

    public array $attributes;
    public Invoice $invoice;
    public Attachment $attachment;

    /**
     * Create a new job instance.
     *
     * @param array $attributes
     */
    public function __construct(Invoice $invoice, $attributes = [])
    {

        $this->attributes = Validator::make($attributes, [
            'holder_name' => ['required', 'filled'],
            'file' => ['required', 'filled', 'file']
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
        /** @var UploadedFile $file */
        $file = $this->attributes['file'];
        $this->attachment = $this->create($file, ['title' => $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension()]);
        $pivot = new InvoiceAttachment();
        $pivot->invoice()->associate($this->invoice);
        $pivot->attachment()->associate($this->attachment);
        $pivot->save();

        if ($pivot->exists) {
            event(new InvoicePaymentConfirmationUploaded($this->invoice, $this->attachment));
        }
    }
}
