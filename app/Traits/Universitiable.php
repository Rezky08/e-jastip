<?php

namespace App\Traits;

use App\Models\Master\University;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Universitiable
{
    public function universities(): MorphToMany
    {
        $relatedClass = University::class;
        return $this->morphToMany($relatedClass, 'universitiable', 'm_universitiables', 'universitiable_id');
    }
}

