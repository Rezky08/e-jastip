<?php

namespace App\Models\Transaction;

use App\Contracts\InvoiceableContract;
use App\Models\Geo\City;
use App\Models\Geo\District;
use App\Models\Geo\Province;
use App\Models\Master\Faculty;
use App\Models\Master\StudyProgram;
use App\Models\Master\University;
use App\Models\Master\User\User;
use App\Models\Transaction\Invoice\Invoice;
use App\Traits\Invoiceable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jalameta\Attachments\Concerns\Attachable;
use Jalameta\Attachments\Contracts\AttachableContract;
use Jalameta\Attachments\Entities\Attachment;

/**
 * @property int $user_id
 * @property int $university_id
 * @property int $faculty_id
 * @property string $study_program_id
 * @property int $origin_province_id
 * @property int $origin_city_id
 * @property int $origin_district_id
 * @property string $origin_zip_code
 * @property string $origin_address
 * @property int $destination_province_id
 * @property int $destination_city_id
 * @property int $destination_district_id
 * @property string $destination_zip_code
 * @property string $destination_address
 * @property string $partner_shipment_code
 * @property string $partner_shipment_service
 * @property string $partner_shipment_price
 * @property string $partner_shipment_etd
 * @property string $status
 * @property Attachment $file
 * @property User $user
 * @property University $university
 * @property Faculty $faculty
 * @property StudyProgram $studyProgram
 * @property Province $originProvince
 * @property City $originCity
 * @property District $originDistrict
 * @property Province $destinationProvince
 * @property City $destinationCity
 * @property District $destinationDistrict
 * @property Collection $invoices
 * @property Invoice $invoice
 */
class Transaction extends Model implements InvoiceableContract, AttachableContract
{
    use HasFactory, Invoiceable, HasTable, Attachable;

    protected $table = "t_transactions";

    protected $fillable = [
        'user_id',
        'student_id',
        'name',
        'university_id',
        'faculty_id',
        'study_program_id',
        'origin_province_id',
        'origin_city_id',
        'origin_district_id',
        'origin_zip_code',
        'origin_address',
        'destination_province_id',
        'destination_city_id',
        'destination_district_id',
        'destination_zip_code',
        'destination_address',
        'partner_shipment_code',
        'partner_shipment_service',
        'partner_shipment_price',
        'partner_shipment_etd',
        'status',
    ];

    protected static int $TOKEN_LENGTH = 12;

    const TRANSACTION_STATUS_CREATED = 1;
    const TRANSACTION_STATUS_WAITING_PAYMENT = 2;
    const TRANSACTION_STATUS_PAID = 3;
    const TRANSACTION_STATUS_IN_PROGRESS = 4;
    const TRANSACTION_STATUS_DONE = 5;
    const TRANSACTION_STATUS_WAITING_PICKUP = 6;
    const TRANSACTION_STATUS_IN_SHIPPING = 7;
    const TRANSACTION_STATUS_ARRIVED = 8;
    const TRANSACTION_STATUS_CONFIRMED = 9;
    const TRANSACTION_STATUS_FINISHED = 10;


    static public function getAvailableStatus(): array
    {
        return [
            self::TRANSACTION_STATUS_CREATED => 'Created',
            self::TRANSACTION_STATUS_WAITING_PAYMENT => 'Menunggu Pembayaran',
            self::TRANSACTION_STATUS_PAID => 'Telah Terbayar',
            self::TRANSACTION_STATUS_IN_PROGRESS => 'Dalam Proses',
            self::TRANSACTION_STATUS_DONE => 'Selesai Diproses',
            self::TRANSACTION_STATUS_WAITING_PICKUP => 'Menunggu dijemput',
            self::TRANSACTION_STATUS_IN_SHIPPING => 'Dalam Pengiriman',
            self::TRANSACTION_STATUS_ARRIVED => 'Sampai Tujuan',
            self::TRANSACTION_STATUS_CONFIRMED => 'Telah Diterima',
            self::TRANSACTION_STATUS_FINISHED => 'Selesai',
        ];
    }

    protected static function generateToken()
    {
        $randomString = substr(md5(time()), 0, self::$TOKEN_LENGTH);
        return $randomString;
    }

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub


        static::creating(function (self $transaction) {
            $transactionQuery = self::query();

            // check before store
            $randomString = self::generateToken();

            while (true) {
                /** @var Transaction $transactionResult */
                $transactionResult = $transactionQuery->where('token', $randomString)->first();
                if (!$transactionResult) {
                    break;
                } else {
                    $randomString = self::generateToken();
                }
            }

            $transaction->setAttribute('token', $randomString);
        });
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    function university(): BelongsTo
    {
        return $this->belongsTo(University::class, 'university_id', 'id');
    }

    function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }

    function studyProgram(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_id', 'id');
    }

    public function originProvince(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Province::class, 'origin_province_id', 'province_id');
    }

    public function originCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'origin_city_id', 'city_id');
    }

    public function originDistrict(): BelongsTo
    {
        return $this->belongsTo(District::class, 'origin_district_id', 'district_id');
    }

    public function destinationProvince(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Province::class, 'destination_province_id', 'province_id');
    }

    public function destinationCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'destination_city_id', 'city_id');
    }

    public function destinationDistrict(): BelongsTo
    {
        return $this->belongsTo(District::class, 'destination_district_id', 'district_id');
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(Attachment::class, "file", "id");
    }

    public function documents()
    {
        return $this->hasMany(\App\Models\Transaction\Transaction\Attachment::class, 'transaction_id', 'id');
    }

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class,'transaction_id','id');
    }


}
