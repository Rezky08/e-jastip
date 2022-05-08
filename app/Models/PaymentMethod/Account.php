<?php

namespace App\Models\PaymentMethod;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property PaymentMethod $paymentMethod
 * @property Type $type
 *
 */
class Account extends Model
{
    use HasFactory, HasTable;

    protected $table = 'm_payment_method_accounts';

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, "payment_method_id", "id");
    }

    public function type()
    {
        return $this->hasOneThrough( Type::class,PaymentMethod::class, 'id', 'id', 'payment_method_id', 'payment_method_type_id');
    }
}
