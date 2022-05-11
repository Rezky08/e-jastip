<?php

namespace App\Jobs\Transaction\Transaction;

use App\Events\Transaction\Transaction\TransactionCreated;
use App\Models\Geo\City;
use App\Models\Geo\District;
use App\Models\Geo\Province;
use App\Models\Master\Faculty;
use App\Models\Master\StudyProgram;
use App\Models\Master\User\User;
use App\Models\Transaction\Transaction;
use App\Supports\Repositories\AuthRepository;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Jalameta\Attachments\Concerns\AttachmentCreator;
use Jalameta\Attachments\Entities\Attachment;

class CreateTransaction
{
    use Dispatchable, SerializesModels, AttachmentCreator;

    protected array $attributes;
    public \App\Models\Transaction\Transaction $transaction;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attributes = [], $status = Transaction::TRANSACTION_STATUS_CREATED)
    {
        $attributes = array_merge(['status' => $status], $attributes);
        $this->attributes = Validator::make($attributes, [
            'province_id' => ['required', 'filled', 'exists:' . Province::getTableName() . ',province_id'],
            'city_id' => ['required', 'filled', 'exists:' . City::getTableName() . ',city_id'],
            'district_id' => ['required', 'filled', 'exists:' . District::getTableName() . ',district_id'],
            'zip_code' => ['required', 'filled'],
            'address' => ['required', 'filled'],
            'partner_shipment' => ['filled'],
            'file' => ['required', 'filled', 'file'],
            'partner_shipment_code' => ['nullable'],
            'partner_shipment_service' => ['nullable'],
            'partner_shipment_price' => ['nullable'],
            'partner_shipment_etd' => ['nullable'],
            'status' => ['required', Rule::in(Transaction::getAvailableStatus())]
        ])->validate();
        unset($this->attributes['partner_shipment']);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(AuthRepository $repository)
    {
        // TODO: Upload File
        /** @var UploadedFile $file */
        $file = $this->attributes['file'];
        $attachment = $this->create($this->attributes['file'], ['title' => $file->getClientOriginalName()]);

        throw_if(!($attachment instanceof Attachment), ValidationException::withMessages(['file' => 'Gagal Melakukan Upload File']));

        /** @var User $user */
        $user = $repository->getUser();
        $faculty = $user->faculty;
        $studyProgram = $user->studyProgram;

        // TODO: Assign Into Existing User
        $this->attributes['user_id'] = $user->id;
        $this->attributes['faculty_id'] = $faculty->id;
        $this->attributes['study_program_id'] = $studyProgram->id;
        $this->transaction = new \App\Models\Transaction\Transaction($this->attributes);
        $this->transaction->save();

        $this->transaction->attachments()->attach($attachment);

        if ($this->transaction->exists) {
            \event(new TransactionCreated($this->transaction));
        }
    }
}
