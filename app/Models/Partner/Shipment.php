<?php

namespace App\Models\Partner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory,HasTable;
    protected $table = "m_partner_shipment";
}
