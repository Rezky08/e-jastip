<?php

namespace App\Models\PaymentMethod;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;


/**
 * Type model.
 *
 * @property int                                                                         $id
 * @property string                                                                      $type
 * @property string                                                                      $label
 * @property \Carbon\Carbon                                                              $created_at
 * @property \Carbon\Carbon                                                              $updated_at
 * @property-read Collection|null                                                     $paymentMethods
 */
class Type extends Model
{
    use HasFactory;
    protected $table = 'm_payment_method_types';

    public function paymentMethods(){
        return $this->hasMany(PaymentMethod::class,"payment_method_type_id","id");
    }
}
