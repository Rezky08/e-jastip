<?php

namespace App\Jobs\Master\University;

use App\Contracts\UniversitiableContract;
use App\Events\Master\University\UniversitiableAttached;
use App\Models\Master\University;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AttachUniversitiable
{
    use Dispatchable, SerializesModels;

    public UniversitiableContract $universitiable;
    public University $university;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UniversitiableContract $universitiable, University $university)
    {
        $this->universitiable = $universitiable;
        $this->university = $university;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->universitiable->universities()->attach($this->university);
        $this->universitiable->save();
        event(new UniversitiableAttached($this->universitiable->refresh()));
    }
}
