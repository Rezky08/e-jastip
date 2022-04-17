<?php

namespace App\Models\PaymentMethod;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Type model.
 *
 * @property int                                                                         $id
 * @property string                                                                      $type
 * @property string                                                                      $label
 * @property \Carbon\Carbon                                                              $created_at
 * @property \Carbon\Carbon                                                              $updated_at
 * @property-read PaymentMethod|null                                                     $paymentMethods
 */
class Type extends Model
{
    use HasFactory;
    protected $table = 'payment_method_types';

    public function paymentMethods(){
        return $this->hasMany(PaymentMethod::class,"payment_method_type_id","id");
    }
}
