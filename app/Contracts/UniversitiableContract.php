<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface UniversitiableContract
{
    public function universities(): MorphToMany;
}
