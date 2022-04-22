<?php

namespace App\Models\PaymentMethod;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory;
    protected $table = 'm_payment_method_accounts';

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class,"payment_method_id","id");
    }
}
