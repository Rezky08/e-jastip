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
    const KEY_BIAYA_APP_PERCENTAGE = 'biaya_app_percent';
    const KEY_BIAYA_OPS_PERCENTAGE = 'biaya_ops_percent';
    const KEY_BIAYA_JASTIP_PERCENTAGE = 'biaya_jst_percent';
    const KEY_PENGIRIMAN_KOTA_ASAL = 'pengiriman_kota_asal';
    const KEY_MAX_TRANSACTION_ATTACHMENT = 'max_trans_att';
    const KEY_MAX_SPRINTER_ORDER_TAKEN = 'max_sp_ord_tak';
    const KEY_MAX_SPRINTER_UPLOAD_PROOF = 'max_sp_up_prf';
}
