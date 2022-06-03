<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $key
 * @property string $value
 */
class Setting extends Model
{
    use HasFactory,HasTable;
    protected $table = 'm_settings';
    protected $primaryKey='key';
    public $incrementing = false;
    public $timestamps=false;

    const KEY_BIAYA_LAYANAN = 'biaya_layanan';
    const KEY_PENGIRIMAN_KOTA_ASAL = 'pengiriman_kota_asal';
    const KEY_MAX_TRANSACTION_ATTACHMENT = 'max_trans_att';
    const KEY_MAX_SPRINTER_ORDER_TAKEN = 'max_sp_ord_tak';
}
