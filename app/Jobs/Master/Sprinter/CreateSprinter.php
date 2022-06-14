<?php

namespace App\Jobs\Master\Sprinter;

use App\Events\Master\Sprinter\SprinterCreated;
use App\Jobs\Master\University\AttachUniversitiable;
use App\Models\Master\Sprinter\Sprinter;
use App\Models\Master\University;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateSprinter
{
    use Dispatchable, SerializesModels;

    public array $attributes;
    public Sprinter $sprinter;
    public University|Model $university;
    public AttachUniversitiable $attachUniversityJob;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attributes = [])
    {
        $this->attributes = Validator::make($attributes, [
            'name' => ['required', 'filled'],
            'university_id' => ['required', 'filled', 'exists:' . University::getTableName() . ',id'],
            'email' => ['required', 'filled', 'email', 'unique:' . Sprinter::getTableName() . ',email'],
            'password' => ['required', 'filled', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ])->validate();
        $this->university = University::query()->findOrFail($this->attributes['university_id']);
        unset($this->attributes['university_id']);
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->sprinter = new Sprinter($this->attributes);
        $this->sprinter->save();

        if ($this->sprinter->exists) {
            event(new SprinterCreated($this->sprinter));
        }

        $this->attachUniversityJob = new AttachUniversitiable($this->sprinter,$this->university);
        dispatch($this->attachUniversityJob);

        return $this->sprinter->exists;
    }
}
