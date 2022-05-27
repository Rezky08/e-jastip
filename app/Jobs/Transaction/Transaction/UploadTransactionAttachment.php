<?php

namespace App\Jobs\Transaction\Transaction;

use App\Models\Transaction\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Jalameta\Attachments\Concerns\AttachmentCreator;
use Jalameta\Attachments\Entities\Attachment;

class UploadTransactionAttachment
{
    use Dispatchable, SerializesModels, AttachmentCreator;

    public array $attributes;

    public Collection $transactionDocuments;
    public Transaction $transaction;
    public $disk = 'document';


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction, $attributes, $keyName = 'documents')
    {
        $this->attributes = Validator::make($attributes, [
            ($keyName ? $keyName . "." : "") . '*.file' => ['required', 'filled', 'file'],
            ($keyName ? $keyName . "." : "") . '*.name' => ['filled', 'distinct'],
            ($keyName ? $keyName . "." : "") . '*.qty' => ['required', 'filled', 'min:1'],
        ])->validate();

        if (!empty($keyName)) {
            $this->attributes = $this->attributes[$keyName];
        }
        $this->transactionDocuments = new Collection();
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // TODO: Upload File

        $attachments = new Collection();

        /** @var UploadedFile $file */
        foreach ($this->attributes as $document) {
            $file = $document['file'];
            $fileName = ($document['name'] ?? $file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
            $attachment = $this->create($file, [
                'title' => $fileName,
                'disk' => $this->disk
            ]);


            throw_if(!($attachment instanceof Attachment), ValidationException::withMessages(['file' => 'Gagal Melakukan Upload File']));

            $trasnactionDocument = new \App\Models\Transaction\Transaction\Attachment();
            $trasnactionDocument->fill([
                'name' => $document['name'],
                'attachment_id' => $attachment->id,
                'qty' => $document['qty']
            ]);
            $this->transactionDocuments->add($trasnactionDocument);

            $attachments->add($attachment);
        };

        $this->transaction->documents()->saveMany($this->transactionDocuments);
        $this->transactionDocuments = $this->transaction->documents;
    }
}
