<?php

namespace App\Jobs\Master\Admin;

use App\Events\Master\Admin\AdminCreated;
use App\Jobs\Master\University\AttachUniversitiable;
use App\Models\Master\Admin;
use App\Models\Master\Faculty;
use App\Models\Master\University;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateAdmin
{
    use Dispatchable, SerializesModels;

    public array $attributes;
    public Admin $admin;
    public AttachUniversitiable $attachUniversityJob;

    public University|Model|null $university = null;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attributes = [])
    {
        $this->attributes = Validator::make($attributes, [
            'name' => ['required', 'filled'],
            'email' => ['required', 'filled', 'email', 'unique:' . Admin::getTableName() . ',email'],
            'university_id' => ['nullable', 'exists:' . University::getTableName() . ',id'],
            'password' => ['required', 'filled', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ])->validate();
        if (Arr::has($this->attributes,['university_id'])){
            $this->university = University::query()->find($this->attributes['university_id']);
            unset($this->attributes['university_id']);
        }
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->admin = new Admin($this->attributes);
        $this->admin->save();
        if ($this->admin->exists) {
            event(new AdminCreated($this->admin));
        }

        if ($this->university){
            $this->attachUniversityJob = new AttachUniversitiable($this->admin,$this->university);
            dispatch($this->attachUniversityJob);
        }

        return $this->admin->exists;
    }
}
