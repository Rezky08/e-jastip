<?php

namespace App\Models\Master\Pivot;

use App\Models\Master\Admin;
use App\Models\Master\University;
use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AdminUniversity extends Pivot
{
    use HasTable;
    protected $table = "m_admin_universities";

    public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function university(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(University::class, 'university_id', 'id');
    }
}
