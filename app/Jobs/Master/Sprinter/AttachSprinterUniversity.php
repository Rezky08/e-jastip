<?php

namespace App\Jobs\Master\Sprinter;

use App\Events\Master\Sprinter\SprinterAttachedUniversity;
use App\Models\Master\Sprinter\Sprinter;
use App\Models\Master\University;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AttachSprinterUniversity
{
    use Dispatchable, SerializesModels;

    public Sprinter $sprinter;
    public University $university;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Sprinter $sprinter, University $university)
    {
        $this->sprinter = $sprinter;
        $this->university = $university;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sprinter->universities()->attach($this->university);
        $this->sprinter->save();
        event(new SprinterAttachedUniversity($this->sprinter->refresh()));
    }
}
