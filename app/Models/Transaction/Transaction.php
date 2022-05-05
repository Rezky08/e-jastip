<?php

namespace App\Models\Transaction;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\InvoiceableContract;
use App\Models\Geo\City;
use App\Models\Geo\District;
use App\Models\Geo\Province;
use App\Models\User;
use App\Traits\Invoiceable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\This;

/**
 * @property string $user_id
 * @property string $province_id
 * @property string $city_id
 * @property string $district_id
 * @property string $zip_code
 * @property string $address
 * @property string $partner_shipment_code
 * @property string $partner_shipment_service
 * @property string $partner_shipment_price
 * @property string $partner_shipment_etd
 * @property string $status
 * @property Province $province
 * @property City $city
 * @property District $district
 * @property Collection $invoices
 */
class Transaction extends Model implements InvoiceableContract
{
    use HasFactory, Invoiceable;

    protected $table = "t_transactions";

    protected $fillable = [
        'user_id',
        'province_id',
        'city_id',
        'district_id',
        'zip_code',
        'address',
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
            self::TRANSACTION_STATUS_CREATED,
            self::TRANSACTION_STATUS_WAITING_PAYMENT,
            self::TRANSACTION_STATUS_PAID,
            self::TRANSACTION_STATUS_IN_PROGRESS,
            self::TRANSACTION_STATUS_DONE,
            self::TRANSACTION_STATUS_WAITING_PICKUP,
            self::TRANSACTION_STATUS_IN_SHIPPING,
            self::TRANSACTION_STATUS_ARRIVED,
            self::TRANSACTION_STATUS_CONFIRMED,
            self::TRANSACTION_STATUS_FINISHED,
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

    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function province(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }


    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'district_id');
    }


}