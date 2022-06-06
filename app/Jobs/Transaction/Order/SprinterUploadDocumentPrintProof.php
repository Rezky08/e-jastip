<?php

namespace App\Jobs\Transaction\Order;

use App\Models\Pivot\Transaction\TransactionLogablePivot;
use App\Models\Setting\Setting;
use App\Models\Transaction\Order;
use App\Models\Transaction\Transaction;
use App\Supports\SettingSupport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Jalameta\Attachments\Concerns\AttachmentCreator;
use Jalameta\Attachments\Entities\Attachment;

class SprinterUploadDocumentPrintProof
{
    use Dispatchable, SerializesModels, AttachmentCreator;

    public array $attributes;

    public Collection $transactionDocuments;
    public Transaction $transaction;
    public $disk = 'print-proof';
    public Order $order;
    private MorphPivot $log;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order, $attributes = [])
    {
        $this->attributes = Validator::make($attributes, [
            'file' => ['required','filled','max:3'],
            'file.*' => ['required', 'filled', 'file', 'image', 'max:5000'],
        ])->validate();
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /** @var UploadedFile $file */
        foreach ($this->attributes['file'] as $file) {
            $fileName = ($attribute['name'] ?? $file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
            $attachment = $this->create($file, [
                'title' => $fileName,
                'disk' => $this->disk
            ]);


            throw_if(!($attachment instanceof Attachment), ValidationException::withMessages(['file' => 'Gagal Melakukan Upload File']));

            $this->order->attachments()->attach($attachment);
            $this->order->save();

        };
    }
}
