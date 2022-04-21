<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $key
 * @property string $value
 */
class Setting extends Model
{
    use HasFactory;
    protected $table = 'm_settings';
    protected $primaryKey='key';
    public $incrementing = false;
    public $timestamps=false;

    const KEY_BIAYA_LAYANAN = 'biaya_layanan';
}
