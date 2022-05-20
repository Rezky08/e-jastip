<?php

namespace App\Jobs\Transaction\Transaction;

use App\Events\Transaction\Transaction\TransactionCreated;
use App\Models\Geo\City;
use App\Models\Geo\District;
use App\Models\Geo\Province;
use App\Models\Master\User\User;
use App\Models\Transaction\Transaction;
use App\Supports\Notification\ToastSupport;
use App\Supports\Repositories\AuthRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CreateTransaction
{
    use Dispatchable, SerializesModels;

    protected array $attributes;
    public \App\Models\Transaction\Transaction $transaction;
    public UploadTransactionAttachment $uploadDocumentJob;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attributes = [], $status = Transaction::TRANSACTION_STATUS_CREATED)
    {
        $attributes = array_merge(['status' => $status], $attributes);
        try {
            $this->attributes = Validator::make($attributes, [
                'name' => ['required','filled'],
                'student_id' => ['required','filled'],
                'origin_province_id' => ['required', 'filled', 'exists:' . Province::getTableName() . ',province_id'],
                'origin_city_id' => ['required', 'filled', 'exists:' . City::getTableName() . ',city_id'],
                'origin_district_id' => ['required', 'filled', 'exists:' . District::getTableName() . ',district_id'],
                'origin_zip_code' => ['required', 'filled'],
                'origin_address' => ['required', 'filled'],
                'destination_province_id' => ['required', 'filled', 'exists:' . Province::getTableName() . ',province_id'],
                'destination_city_id' => ['required', 'filled', 'exists:' . City::getTableName() . ',city_id'],
                'destination_district_id' => ['required', 'filled', 'exists:' . District::getTableName() . ',district_id'],
                'destination_zip_code' => ['required', 'filled'],
                'destination_address' => ['required', 'filled'],
                'partner_shipment' => ['filled'],
                'partner_shipment_code' => ['nullable'],
                'partner_shipment_service' => ['nullable'],
                'partner_shipment_price' => ['nullable'],
                'partner_shipment_etd' => ['nullable'],
                'status' => ['required', Rule::in(Transaction::getAvailableStatus())]
            ])->validate();
            $this->uploadDocumentJob = new UploadTransactionAttachment(new Transaction(),$attributes['documents']);
        } catch (ValidationException $e) {
            ToastSupport::add($e->getMessage(), "Error");
            throw $e;
        }
        unset($this->attributes['partner_shipment']);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(AuthRepository $repository)
    {

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

        $this->uploadDocumentJob->transaction = $this->transaction;

        dispatch($this->uploadDocumentJob);

        if ($this->transaction->exists) {
            \event(new TransactionCreated($this->transaction));
        }
    }
}
