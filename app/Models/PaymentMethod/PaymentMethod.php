<?php

namespace App\Models\PaymentMethod;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;


/**
 * Payment Method model.
 *
 * @property int                                                                         $id
 * @property int                                                                         $payment_metod_type_id
 * @property string                                                                      $code
 * @property string                                                                      $label
 * @property string                                                                      $icon
 * @property \Carbon\Carbon                                                              $created_at
 * @property \Carbon\Carbon                                                              $updated_at
 * @property-read Type|null                                                              $type
 * @property-read Collection|null                                                        $accounts
 */
class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'm_payment_methods';

    const TYPE_QRIS = "qris";
    const TYPE_TRANSFER = "transfer";
    const TYPE_OTHER = "other";

    static public function getAvailableTypes()
    {
        return [
            self::TYPE_QRIS => [
                'type' => self::TYPE_QRIS,
                'label' => ucfirst(self::TYPE_QRIS),
                'template' => ""
            ],
            self::TYPE_TRANSFER => [
                'type' => self::TYPE_TRANSFER,
                'label' => ucfirst(self::TYPE_TRANSFER),
                'template' => ""
            ],
            self::TYPE_OTHER => [
                'type' => self::TYPE_OTHER,
                'label' => ucfirst(self::TYPE_OTHER),
                'template' => ""
            ],
        ];
    }

    static public function getAvailableMethods(){
        $types = self::getAvailableTypes();
        return [
            [
                'type' => PaymentMethod::TYPE_TRANSFER,
                'label' => $types[PaymentMethod::TYPE_TRANSFER]['label'],
                'paymentMethod' => [
                    [
                        'code' => 'bca',
                        'icon' => 'img/bca.svg',
                        'label' => 'Bank Central Asia (BCA)',
                        'isActive' => true
                    ],
                    [
                        'code' => 'mandiri',
                        'icon' => 'img/mandiri.svg',
                        'label' => 'Mandiri',
                        'isActive' => true
                    ],
                    [
                        'code' => 'bri',
                        'icon' => 'img/bri.svg',
                        'label' => 'Bank Rakyat Indonesia (BRI)',
                        'isActive' => true
                    ],
                    [
                        'code' => 'bni',
                        'icon' => 'img/bni.svg',
                        'label' => 'Bank Negara Indonesia (BNI)',
                        'isActive' => true
                    ],
                ]
            ],
            [
                'type' => PaymentMethod::TYPE_QRIS,
                'label' => $types[PaymentMethod::TYPE_QRIS]['label'],
                'paymentMethod' => [
                    [
                        'code' => 'shopee',
                        'icon' => 'img/shopee.svg',
                        'label' => 'Shopee Pay',
                        'isActive' => true
                    ],
                    [
                        'code' => 'gopay',
                        'icon' => 'img/gopay.svg',
                        'label' => 'Gopay',
                        'isActive' => true
                    ],
                    [
                        'code' => 'ovo',
                        'icon' => 'img/ovo.svg',
                        'label' => 'OVO',
                        'isActive' => true
                    ],
                    [
                        'code' => 'dana',
                        'icon' => 'img/dana.svg',
                        'label' => 'DANA',
                        'isActive' => true
                    ],
                ]
            ],
            [
                'type' => PaymentMethod::TYPE_OTHER,
                'label' => $types[PaymentMethod::TYPE_OTHER]['label'],
                'paymentMethod' => [
                    [
                        'code' => 'indomaret',
                        'icon' => 'img/indomaret.svg',
                        'label' => 'Indomaret',
                        'isActive' => true
                    ],
                    [
                        'code' => 'alfamart',
                        'icon' => 'img/alfamart.svg',
                        'label' => 'Alfamart',
                        'isActive' => true
                    ],
                ]
            ]
        ];
    }

    public function type(){
        return $this->belongsTo(Type::class,"payment_method_type_id","id");
    }
    public function accounts(){
        return $this->hasMany(Account::class,"payment_method_id","id");
    }

}
